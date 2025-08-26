// Utiliser sessionStorage pour cacher les resultats de recherche et permettre le retour en arrier vers les resutlats de recherche

// permetre de choisir la puissance de l'ampli, 1W ou 2.83V
// peut etre pas une bonne idee car je vais devoir ajuster la sensiblite


class Histogram {
  constructor (data) {
    let width = data.length
    let height = 16

    if (0 < width) {
      this.svg = `<svg width="${width}" height="${height}" fill="red" xmlns="http://www.w3.org/2000/svg">`
      data.forEach((r, x) => {
        // this.svg += `<rect width="1.2" height="16" x="${x}" y="0" fill="rgb(${r}, 133, 208)"/>`
        this.svg += `<rect width="2" height="${height}" x="${x}" y="0" fill="hsl(${r}deg 72.61% 47.25%)"/>`
      })
      this.svg += "</svg>"

    } else { // Empty array
      width = 200
      this.svg  = `<svg width="${width}" height="${height}" xmlns="http://www.w3.org/2000/svg">`
      this.svg += `<rect width="${width}" height="${height}" x="0" y="0" fill="hsl(206deg 72.61% 47.25%)"/>`
      this.svg += "</svg>"
    }
  }
}



class SliderFormater {
  // (12.48, 1) => 12.4
	// (12.48, 3) => 12.480
  static fixedFloor(value, digits) {
		const multiplier = Math.pow(10, digits)
		return (Math.floor(value * multiplier) / multiplier).toFixed(digits)
  }

  // (3.42, 1) => 3.5
	// (3.42, 3) => 3.420
  static fixedCeil(value, digits) {
		const multiplier = Math.pow(10, digits)
		return (Math.ceil(value * multiplier) / multiplier).toFixed(digits)
  }

  static fixed(value, digits, min_max) {
    if (min_max == "min") {
      return this.fixedFloor(value, digits)
    } else {
      return this.fixedCeil(value, digits)
    }
  }

  // with digits = 3
  // 1.234    # => 1.23
  // 1234.5   # => 1234
  static significant(value, digits, min_max) {
    if (value < 1) {
      return this.fixed(value, digits, min_max)
    } else if (value < 10) {
      return this.fixed(value, Math.max(0, digits - 1), min_max)
    } else if (value < 100) {
      return this.fixed(value, Math.max(0, digits - 2), min_max)
    } else if (value < 1000) {
      return this.fixed(value, Math.max(0, digits - 3), min_max)
    } else {
      return this.fixed(value, Math.max(0, digits - 4), min_max)
    }
  }

  static format(symbol, value, min_max) {
    switch (symbol) {
      case 'vc_diam':
      case 'dd':
      case 'cms':
        return this.fixed(value, 0, min_max)
      case 'size_in':
      case 'spl1w':
      case 'xmax':
      case 're':
        return this.fixed(value, 1, min_max)
      case 'qms':
      case 'qes':
      case 'qts':
        return this.fixed(value, 2, min_max)
      case 'fs':
      case 'kms':
        return this.significant(value, 3, min_max)
      case 'le':
        if (value < 0.1) {
          return this.fixed(value, 3, min_max)
        } else {
          return this.significant(value, 3, min_max)
        }
      case 'vd':
      case 'bl':
      case 'blre':
      case 'vas':
      case 'rms':
      case 'volume':
      case 'weight':
        if (value < 1.0) {
          return this.fixed(value, 2, min_max)
        } else {
          return this.significant(value, 3, min_max)
        }
      case 'sd':
      case 'mms':
        if (value < 100) {
          return this.fixed(value, 1, min_max)
        } else {
          return this.fixed(value, 0, min_max)
        }
      default:
        return value
    }
  }
}



class Slider {
  constructor (div, search_div, start_min, start_max) {
    this.div        = div
    this.symbol     = div.dataset.slider
    this.slider     = div.querySelector(".slider")
    this.input_min  = div.querySelector("input.min")
    this.input_max  = div.querySelector("input.max")
    this.sort_div   = div.querySelector(".sort")
    
    this.range      = {}
    const raw_range = JSON.parse(div.querySelector('.range_data').innerHTML)
    const range_size = raw_range.keys.length
    this.range["min"] = raw_range.values.first()
    raw_range.keys.forEach((value, index) => { 
      if (index != 0 && index != (range_size - 1)) {
        this.range[value] = raw_range.values[index]
      }
    })
    this.range["max"] = raw_range.values.last()

    this.start_min = start_min || this.range['min']
    this.start_max = start_max || this.range['max']

    this.create_slider()
    this.add_event_listeners(search_div, this.symbol)
    this.highlight_bug()
  }

  create_slider () {
    noUiSlider.create(this.slider, {
      // A handle snaps to a clicked location. It can immediatly be moved, without a mouseup + mousedown.
      behaviour: 'snap', 
      // bar between the handles
      connect: true,
      connect: [true, false, true],
      // force the sliders to jump between the specified values
      snap: true,
      range: this.range,
      start: [this.start_min, this.start_max],
    })

  }


  add_event_listeners (search_div, symbol) {
    const slider_div = this.div
    const slider     = this.slider
    const input_min  = this.input_min
    const input_max  = this.input_max

    // values: Current slider values (Array of String) # do not use!
    // handle: Handle that caused the event (Int)
    // unencoded: Unencoded slider values (Array of Number) 
    slider.noUiSlider.on('update', function( values, handle, unencoded ) {
      switch (handle) {
        case 0:
          input_min.value = SliderFormater.format(symbol, unencoded[0], "min")
        break
        case 1:
          input_max.value = SliderFormater.format(symbol, unencoded[1], "max")
        break
      }
    });

    slider.noUiSlider.on('end', function( values, handle, unencoded ) {
      search_div.search.search()
    })

    input_min.addEventListener('change', function(){
      slider.noUiSlider.set([parseFloat(this.value), null])
      search_div.search.search()
    })

    input_max.addEventListener('change', function(){
      slider.noUiSlider.set([null, parseFloat(this.value)])
      search_div.search.search()
    })

    this.sort_div.addEventListener('click', () => {
      search_div.search.sort_by(slider_div, symbol)
    })
  }


  highlight_bug () {
    // Disable click propagation from input to parent div to avoid to highlight the parent div when the user click on the input.
    this.div.querySelectorAll("input").forEach( input => {
      input.addEventListener("click", (event) => {
        event.stopPropagation()
      })
    })
  }


  histogram (histogram_data) {
    let h = new Histogram(histogram_data)
    this.div.querySelector(".noUi-base").style.backgroundImage = 
      `url('data:image/svg+xml,${h.svg}')`
  }


  get_search_url() {
    let url = ""
    let min_has_changed = this.input_min.value != SliderFormater.format(this.symbol, this.range['min'], "min")
    let max_has_changed = this.input_max.value != SliderFormater.format(this.symbol, this.range['max'], "max")

    if (min_has_changed && max_has_changed) {
      url = '/' + this.input_min.value + '≤' + this.symbol + '≤' + this.input_max.value
    } else if (min_has_changed) {
      url = '/' + this.input_min.value + '≤' + this.symbol
    } else if (max_has_changed) {
      url = '/' + this.symbol + '≤' + this.input_max.value
    }

    // Ruby version
    // if (min_has_changed || max_has_changed) {
    //   url = '/' + this.input_min.value + '_' + this.symbol + '_' + this.input_max.value
    // }

    return url
  }


  set_sort_direction(direction) {
    switch (direction) {
      case 'asc':
        this.sort_div.innerHTML = '⬇'
      break
      case 'desc':
        this.sort_div.innerHTML = '⬆'
      break
      default:
        this.sort_div.innerHTML = '•'
      break
    }
  }
}



class Search {
  constructor (div) {
    this.div = div
    this.dropdowns = []
    this.sliders = []
    this.previous_url = decodeURI(window.location.pathname).
      replace(/^\/search/, '').replace(/^\/$/, '')
    // log(this.previous_url)
    this.sort = {by: null, direction: null}
    const start_parameters = this.parameters_from_url()

    this.div.css('[data-slider]').forEach((slider_div) => {
      if (!slider_div.slider) {
        let symbol = slider_div.dataset.slider
        slider_div.slider = new Slider(slider_div, div, 
          start_parameters[symbol]?.min,
          start_parameters[symbol]?.max)
        if (this.sort.by == symbol) {
          slider_div.slider.set_sort_direction(this.sort.direction)
        }
        this.sliders.push(slider_div.slider)
      }
    })
    
    this.update_histograms()

    this.div.css('[data-dropdown]').forEach((dropdown_div) => {
      if (dropdown_div.dropdown) {
        const dropdown = dropdown_div.dropdown
        dropdown.set_selected_values(start_parameters[dropdown.symbol])
        // dropdown.addEventListener('close', () => {
        dropdown.addEventListener('modified', () => {
          // console.log(dropdown.get_selected_values())
          div.search.search()
        })
        this.dropdowns.push(dropdown)
      }
    })

    //this.setup_trigger_for_next_page(div)
  }


  parameters_from_url() {
    const start_parameters = {}
    const url = this.previous_url
    if (url.includes('=') || url.includes('≤')) {
      url.split('/').forEach(param => {
        if (param.includes('=')) {
          let kv = param.split('=')
          start_parameters[kv[0]] = kv[1].split(',')
        } else
        if (param.includes('≤')) {
          let kv = param.split('≤')
          if (kv.length == 3) {
            start_parameters[kv[1]] = {min: parseFloat(kv[0]), max: parseFloat(kv[2])}
          } else {
            if (/^[0-9\.]+$/.test(kv[0])) {
              start_parameters[kv[1]] = {min: parseFloat(kv[0]), max: null}
            } else {
              start_parameters[kv[0]] = {min: null, max: parseFloat(kv[1])}
            }
          }
        }
      })

    } else {
      // Try to find if it's a brand or a type
      let brand_or_type = url.substring(1)
      console.log(brand_or_type)
      this.div.css('[data-dropdown]').forEach((dropdown_div) => {
        if (dropdown_div.dropdown) {
          const dropdown = dropdown_div.dropdown
          if (dropdown.get_all_values().includes(brand_or_type)) {
            start_parameters[dropdown.symbol] = [brand_or_type]
          }
        }
      })
    }

    if (start_parameters['sort']?.[0]) {
      let sort = start_parameters['sort'][0]
      console.log(sort)
      if (/^\-/.test(sort)) {
        this.sort = {by: sort.substring(1), direction: 'desc'}
      } else {
        this.sort = {by: sort, direction: 'asc'}
      }
    }

    //console.log(start_parameters)
    //console.log(this.sort)
    return start_parameters
  }


  generate_url() {
    let url = ""

    this.dropdowns.forEach((dropdown) => {
      let values = dropdown.get_selected_values()
      if (0 < values.length) {
        url += `/${dropdown.symbol}=${values.join(',')}`
      }
    })
    this.sliders.forEach((slider) => {
      url += slider.get_search_url()
    })

    if (this.sort.direction != null) {
      if (this.sort.direction == 'asc') {
        url += `/sort=${this.sort.by}`
      } else {
        url += `/sort=-${this.sort.by}`
      }
    }
    // log(url)
    return url
  }

  
  search() {
    // console.log(this.previous_url)
    // console.log(this.generate_url())
    let url = this.generate_url()
    if (url != this.previous_url) {
      this.previous_url = url
      history.replaceState(null, "", "/search" + url)
      // history.pushState(null, "", "/search" + url)
      // pushState est une meilleur solution, mais je dois restaurer la recherche manuelement lorsque l'utilisateur clique sur le boutton retour en arriere.
  
      fetch("/search_api" + url)
        .then(response => response.text())
        .then(data => {
          this.div.querySelector(".results").innerHTML = data
          this.div.search.update_histograms()
          this.div.search.write_results_count_into_header()
          _card.initialize_all_new_cards()
          _graph_mini.initialize_all_new_graphs()
          _inf_baffle.fetch_json()
          _highlight.initialize_all_new_specs()
        })
    }
  }


  update_histograms() {
    //let histograms_data = JSON.parse(this.div.querySelector(".results .histograms_data").textContent)
    //this.sliders.forEach((slider) => {
    //  slider.histogram(histograms_data[slider.symbol])
    //})
  }


  sort_by(slider_div, symbol) {
    const active_slider = slider_div.slider

    // if (this.sort.by == null) {
    //   this.sort = {by: symbol, direction: 'asc'}
    // } else 
    if (this.sort.by == symbol) {
      switch (this.sort.direction) {
        case null:
          this.sort.direction = 'asc'
        break
        case 'asc':
          this.sort.direction = 'desc'
        break
        case 'desc':
          // this.sort.direction = null
          this.sort.direction = 'asc'
        break
      }
      active_slider.set_sort_direction(this.sort.direction)

    } else if (this.sort.by != symbol) {
      this.sliders.forEach(slider => {
        slider.set_sort_direction(null)
      });
      this.sort = {by: symbol, direction: 'asc'}
      active_slider.set_sort_direction(this.sort.direction)
    }

    console.log(this.sort)
    this.search()
  }


  results_count() {
    return parseFloat(this.div.querySelector("script.count").innerText)
  }

  write_results_count_into_header() {
    this.div.querySelector('.header span.results_count').innerText = this.results_count() + ' results'
  }


  next_page() {
    let cards_count = this.div.css(".results .woofer_card").length
    let results_count = this.results_count()
    if (cards_count < 400 && cards_count < results_count) {
      let url = `${this.generate_url()}/offset=${cards_count}`
      console.log(url)
      fetch("/next_page_api" + url)
        .then(response => response.text())
        .then(data => {
          let to_add = new DOMParser().parseFromString(data, "text/html")
          // console.log(to_add)
          to_add.querySelectorAll('.woofer_card').forEach((div) => {
            this.div.querySelector(".results").append(div)
          })
          _card.initialize_all_new_cards()
          _graph_mini.initialize_all_new_graphs()
          _inf_baffle.fetch_json()
          _highlight.initialize_all_new_specs()
        })
    }
  }

/*
  setup_trigger_for_next_page(div) {
    let observer = new IntersectionObserver(function(entries) {
      if (entries[0].isIntersecting) {
        // console.log("div.next_page reached!")
        div.search.next_page()
      }
    })
    observer.observe(this.div.querySelector('.next_page'))
  }*/ 
}



document.addEventListener('DOMContentLoaded', (event) => {
  document.css('.search').forEach((div) => {
    if (!div.search) {
      div.search = new Search(div)
    }
  })
});
