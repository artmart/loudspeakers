const _amplifier = {pw: 1}


const _graph = {}

_graph.format_fr = function (fr) {
  if (fr < 100.0) {
    return fr.toPrecision(3)
  } else {
    // return parseFloat(fr.toPrecision(3))
    return numbers_thousands_separators(parseFloat(fr.toPrecision(3)))
  } }

_graph.format_spl = function (spl) {
  return parseFloat(spl).toFixed(1) }

_graph.format_phase = function (phase) {
  return parseFloat(phase).toFixed(0) }

_graph.format_group_delay = function (gd) {
  return parseFloat(gd).toFixed(1) }

_graph.format_excursion = function (x) {
  return parseFloat(x).toFixed(2) }

_graph.format_velocity = function (u) {
  return parseFloat(u).toFixed(2) }

_graph.format_imp = function (z) {
  return parseFloat(z).toFixed(1) }

_graph.format_ms = function (t) {
  return parseFloat(t).toFixed(1) }

_graph.format_time_response = function (t) {
  return parseFloat(t).toFixed(2) }

// j'aurais du faire un objet avec enrgistrement automatique 
// des donnees dans localSorage lors d'une modification
_graph.scale = {
  fr: {
    type: "log", // 'lin' == 'value'
    steps_nb: 688,
    min:    10,
    max: 10000 },
  elec_imp: {
    min:    0,
    max:   60 },
  elec_phase: {
    min: -180,
    max:  180 },
  excursion: {
    min:    0,
    max:   20 },
  velocity: {
    min:    0,
    max:   10 },
  spl: {
    min:   60,
    max:  120 },
  spl_phase: {
    min: -180,
    max:  180 },
  group_delay: {
    min:    0,
    max:   30 },
  time_response: {
    min:   -2,
    max:   20,
    f:    150,
    cycles: 3, },
}
  
_graph.colors = {
  elec_imp:   '#00b5ad', // Teal	
  elec_phase: '#b5cc18', // Yellow
  driver:     '#0086ef', // Blue
  max:        '#FF0303', // Red
  port:       '#21ba45', // Green
  combined:   '#CC00CF'  // Purple
}

_graph.options_selected_color = "graph_elec_imp_color"


_graph.load_options_from_localStorage = function () {
  if (localStorage["graph_scale"]) {
    _graph.scale  = JSON.parse(localStorage['graph_scale'])
  }
  if (localStorage["graph_colors"]) {
    for ( const [k,v] of Object.entries( JSON.parse(localStorage['graph_colors']) ) ) {
      _graph.colors[k] = v
    }
  }
}

// TODO : add "lin" scale 

_graph.initialize_options = () => {
  div_graph_options = document.querySelector('#graph_options')
  if (div_graph_options) {
    
    div_graph_options.querySelectorAll(".color").forEach((div_color) => {
      div_color.addEventListener("click", (event) => {
        _graph.options_selected_color = event.target.id
        div_graph_options.querySelectorAll(".color").forEach((div) => {
          if (div.id == _graph.options_selected_color) {
            div.classList.add("selected")
          } else {
            div.classList.remove("selected")
          }
        })

        setTimeout(()=> {
          // Refactoring: initialize the color picker when the options window is open
          if (!div_graph_options.graph_color_picker) {
            log("picker initialize")
            // github.com/ivanvmat/color-picker
            div_graph_options.graph_color_picker = 
              new ColorPickerControl({ 
                container: div_graph_options.querySelector('#color_picker'), 
                theme: 'light', 
                useAlpha: false });

            div_graph_options.graph_color_picker.on('change', (color) => {
              c = color.toRGBa()
              r = parseInt(c[0])
              g = parseInt(c[1])
              b = parseInt(c[2])
              a = c[3] / 255.0
              rgba = "rgba("+r+", "+g+", "+b+", "+a+")"
              document.getElementById(_graph.options_selected_color).style.backgroundColor = rgba
            })
          } 
          
          // Set the selected color in the color-picker
          color = event.target.style.backgroundColor.split("(")[1].replace(')', '').split(",")
          r = parseInt(color[0].trim())
          g = parseInt(color[1].trim())
          b = parseInt(color[2].trim())
          a = color[3] ? parseFloat(color[3].trim()) * 255 : 255
          div_graph_options.graph_color_picker.color.fromRGBa(r, g, b, a)
        })
      })
    })

    div_graph_options.querySelector("#graph_apply_button").addEventListener("click", () => {
      _graph.apply_options()
    })
    div_graph_options.querySelector("#graph_discard_button").addEventListener("click", () => {
      _graph.load_options()
    })

    let tone_burst_div = document.querySelector('[data-graph="tone_burst"]')
    if (tone_burst_div) {
      tone_burst_div.querySelector("input#graph_tone_burst_f").addEventListener("change", () => {
        // console.log("#graph_tone_burst_f change")
        _graph.apply_options()
      })
      tone_burst_div.querySelector("input#graph_tone_burst_cycles").addEventListener("change", () => {
        // console.log("#graph_tone_burst_cycles change")
        _graph.apply_options()
      })
    }
    
    _graph.load_options()
    // _graph.apply_options()
  }
}


_graph.load_options = function () {
  _graph.load_options_from_localStorage()

  for (const [k, v] of Object.entries(_graph.scale)) {
    // console.log(k)
    if (k == 'time_response') {
      document.querySelector("#graph_"+ k +"_scale_min").value = v["min"]
      document.querySelector("#graph_"+ k +"_scale_max").value = v["max"]
      document.querySelector("#graph_tone_burst_f").value = v["f"]
      document.querySelector("#graph_tone_burst_cycles").value = v["cycles"]
    } else {
      document.querySelector("#graph_"+ k +"_scale_min").value = v["min"]
      document.querySelector("#graph_"+ k +"_scale_max").value = v["max"]
    }
  }

  for (const [k, v] of Object.entries(_graph.colors)) {
    if (k != "max") {
      document.querySelector("#graph_"+ k +"_color").style.backgroundColor = v
    }
  }

  // load the color_picker with the default color
  // document.getElementById(_graph.options_selected_color).click()
}


_graph.apply_options = function () {
  previous_scale = JSON.parse(JSON.stringify(_graph.scale))

  for (const [k, v] of Object.entries(_graph.scale)) {
    if (k == 'time_response') {
      _graph.scale[k]["min"] = parseInt(document.querySelector("#graph_"+ k +"_scale_min").value)
      _graph.scale[k]["max"] = parseInt(document.querySelector("#graph_"+ k +"_scale_max").value)
      _graph.scale[k]["f"]   = parseInt(document.querySelector("#graph_tone_burst_f").value)
      _graph.scale[k]["cycles"] = parseInt(document.querySelector("#graph_tone_burst_cycles").value)
    } else {
      _graph.scale[k]["min"] = parseInt(document.querySelector("#graph_"+ k +"_scale_min").value)
      _graph.scale[k]["max"] = parseInt(document.querySelector("#graph_"+ k +"_scale_max").value)
    }
  }

  for (const [k, v] of Object.entries(_graph.colors)) {
    if (k != "max") {
      _graph.colors[k] = document.querySelector("#graph_"+ k +"_color").style.backgroundColor
    }
  }

  x_axis = {
    type: _graph.scale["fr"]["type"],
    min:  _graph.scale["fr"]["min"],
    max:  _graph.scale["fr"]["max"], }

  document.querySelectorAll("[data-graph]").forEach((div) => {
    let type = div.dataset.graph
    switch (type) {
      case 'spl':
        div.graph.setOption({
          xAxis: x_axis,
          yAxis: {
            min: _graph.scale["spl"]["min"],
            max: _graph.scale["spl"]["max"],
          },
        })
      break

      case 'spl_phase':
        div.graph.setOption({
          xAxis: x_axis,
          yAxis: {
            min: _graph.scale["spl_phase"]["min"],
            max: _graph.scale["spl_phase"]["max"],
          }, 
        })
      break

      case 'group_delay':
        div.graph.setOption({
          xAxis: x_axis,
          yAxis: {
            min: _graph.scale["group_delay"]["min"],
            max: _graph.scale["group_delay"]["max"],
          },
        })
      break

      case 'excursion':
        div.graph.setOption({
          xAxis: x_axis,
          yAxis: {
            min: _graph.scale["excursion"]["min"],
            max: _graph.scale["excursion"]["max"],
            },
        })
      break

      case 'velocity':
        div.graph.setOption({
          xAxis: x_axis,
          yAxis: {
            min: _graph.scale["velocity"]["min"],
            max: _graph.scale["velocity"]["max"],
            },
        })
      break

      case 'imp':
        div.graph.setOption({
          xAxis: x_axis,
          yAxis: [{
            min: _graph.scale["elec_imp"]["min"],
            max: _graph.scale["elec_imp"]["max"],
            },{
            min: _graph.scale["elec_phase"]["min"],
            max: _graph.scale["elec_phase"]["max"],
            }],
        })
      break
    }
  })

  let fr_changed = (
    previous_scale["fr"]["min"] != _graph.scale["fr"]["min"] || 
    previous_scale["fr"]["max"] != _graph.scale["fr"]["max"]   ) ?
    true : false

  let tr_changed = (
    previous_scale["time_response"]["min"]    != _graph.scale["time_response"]["min"] || 
    previous_scale["time_response"]["max"]    != _graph.scale["time_response"]["max"] ||
    previous_scale["time_response"]["f"]      != _graph.scale["time_response"]["f"]   || 
    previous_scale["time_response"]["cycles"] != _graph.scale["time_response"]["cycles"] ) ?
    true : false
  
    // console.log(fr_changed)
    // console.log(tr_changed)
  if (fr_changed || tr_changed) {
    _inf_baffle.fetch_json(true)  // force_overwrite = true
  } else {
    _inf_baffle.draw_the_curves(true) // force_overwrite = false
  }

  // else if (closed_box.data_from_json)
  // else if (box_with_one_port.data_from_json)
  // ...
  
  localStorage["graph_scale"]  = JSON.stringify(_graph.scale)
  localStorage["graph_colors"] = JSON.stringify(_graph.colors)
}


// This feature is buggy, it's a pain to work with and it's overkill. 
// Users don't expect or even notice it, especially those who only use one tab,
// and they are accustomed to refreshing the page to load new options.
// Implementing it for the simulator will be a real pita.
_graph.addEventListener_for_options_changes_on_others_tabs = () => {
  addEventListener('storage', (event) => {
    // console.log(event)
    if (event.key == "graph_colors") {
      _graph.colors = JSON.parse(event.newValue)
      _inf_baffle.draw_the_curves(true) // force_overwrite = true

    } else if (event.key == "graph_scale") {
      oldValue = JSON.parse(event.oldValue)
      newValue = JSON.parse(event.newValue)
      _graph.scale = newValue
      let fr_changed = (
        oldValue["fr"]["min"] != newValue["fr"]["min"] || 
        oldValue["fr"]["max"] != newValue["fr"]["max"]   ) ?
        true : false
      if (fr_changed) {
        _inf_baffle.fetch_json(true)  // force_overwrite = true
      } else {
        _inf_baffle.draw_the_curves(true) // force_overwrite = true
      }
    }
  })
}



_graph.series_default_options = [{
    type: 'line',
    lineStyle: {width: 2},
    symbol: 'none',
    showSymbol: false,
    animation: false,
    z: 10
  },{
    type: 'line',
    lineStyle: {width: 1},
    symbol: 'none',
    showSymbol: false,
    animation: false,
    z: 9
  },{
    type: 'line',
    lineStyle: {width: 1},
    symbol: 'none',
    showSymbol: false,
    animation: false,
    z: 8    
  },{
    type: 'line',
    lineStyle: {width: 1},
    symbol: 'none',
    showSymbol: false,
    animation: false,
    z: 7
  },{
    type: 'line',
    lineStyle: {width: 1},
    symbol: 'none',
    showSymbol: false,
    animation: false,
    z: 6
  },{
    type: 'line',
    lineStyle: {width: 1},
    symbol: 'none',
    showSymbol: false,
    animation: false,
    z: 5
  },{
    type: 'line',
    lineStyle: {width: 1},
    symbol: 'none',
    showSymbol: false,
    animation: false,
    z: 4
  },{
    type: 'line',
    lineStyle: {width: 1},
    symbol: 'none',
    showSymbol: false,
    animation: false,
    z: 3
  },{
    type: 'line',
    lineStyle: {width: 1},
    symbol: 'none',
    showSymbol: false,
    animation: false,
    z: 2
  },{
    type: 'line',
    lineStyle: {width: 1},
    symbol: 'none',
    showSymbol: false,
    animation: false,
    z: 1
  },
]

// Dashed line that follow the mouse
_graph.axisPointer = (units = 'Hz') => {
  return { 
    show: true,
    type: 'line',
    snap: true, // Snap to values
    label: {
      color: '#fff', // Text color
      backgroundColor: 'rgba(0, 0, 0, 0.90)',
      formatter: (params) => {
        let formated_value = (units == 'ms') ?
          _graph.format_ms(params.value) :
          _graph.format_fr(params.value)
        return formated_value + ' ' + units },
      margin: 3, // Distance between label and axis.
      padding: [5, 7, 6, 7],// up, right, down, left
      fontSize: 14	},
    lineStyle: {
      color: 'rgba(0, 0, 0, 0.5)',
      type: 'dashed'	}	}
}

_graph.default_options = () => {
  return {
    textStyle:{
      fontFamily: 'Open Sans',
      color: 'black',
      fontSize: 14 },

    legend: {
      // yqnn.github.io/svg-path-editor/
      icon: 'path://M 0 0 l 30 0 A 1 1 0 0 1 30 4 l -30 0 A 1 1 0 0 1 0 0 Z',
      selectedMode: false,
      itemGap: 40 ,
      top: 9 ,
      // borderColor: 'red' ,
      // borderWidth: 1 ,
      // padding: [12, 40, 0, 40], // up, right, down, left
      animation: false,   },

    grid: {
      left: 	40,
      right: 	40,
      // width: 862,
      top: 		40,
      bottom: 30},

    tooltip: {
      show: true,
      showDelay: 0 ,
      hideDelay: 0 ,
      transitionDuration: 0.0 ,
      textStyle: {
        color: 'black',
        fontSize: 14	},
      padding: [1, 7], // up & down, right & left
      backgroundColor: 'rgba(255, 255, 255, 0.95)',
      borderColor: 'rgba(0, 0, 0, 0.2)',
      borderWidth: 1,
      extraCssText: 'box-shadow: 0 0 0px rgba(0, 0, 0, 0.0);'
    },

    xAxis: {
      type: _graph.scale["fr"]["type"],
      min:  _graph.scale["fr"]["min"],
      max:  _graph.scale["fr"]["max"],
      minorTick: {
        show: true,
        splitNumber: 9 },
      minorSplitLine: { 
        show: true,
        lineStyle: {
          color: '#ccc',
          opacity: 0.35	} },
      axisLine: { onZero: false },
      axisLabel: {
        fontSize: 14,
        formatter: function (params) {
        return params.toString().replace(/000$/, " 000")	},},
      axisPointer: _graph.axisPointer('Hz'),
      animation: false
    },

    yAxis: {
      type: 'value',
      // minorTick: {
      //  show: true,
      // 	splitNumber: 5 },
      // minorSplitLine: { 
      // 	show: true,
      // 	lineStyle: {
      // 		color: '#ccc',
      // 		opacity: 0.35	} },
      nameTextStyle: { 
        // borderColor: 'red' ,
        // borderWidth: 1 ,
        fontSize: 14,
        align: 'right',
        padding: [0, 8, -2, 0] },
      position: 'left',
      axisLine: { onZero: false },
      axisLabel: { fontSize: 14	},
      animation: false
    },

    series: _graph.series_default_options,
  }
}


_graph.tooltip_tr = (serie) => `
  <tr style="color:${serie.color}">
    <td class="name">${serie.name}</td>
    <td class="value">${serie.value}</td>
    <td class="units">${serie.units}</td>
  </tr>
`

_graph.tooltip = (series, fr, units = 'Hz') => `
  <table class="echarts_tooltip">
    <tbody>
      <tr>
        <td class="head value">
          ${units === 'ms' ? _graph.format_ms(fr) : _graph.format_fr(fr)}
        </td>
        <td class="units">${units}</td>
      </tr>
      ${series.map(_graph.tooltip_tr).join('')}
    </tbody>
  </table>
`


_graph.spl_options = () => {
  return {
    yAxis: {
      name: 'dB',
      min: _graph.scale["spl"]["min"],
      max: _graph.scale["spl"]["max"],
      // interval: 10  
    },	

    series: [{
      name: 'SPL (1W, 1m, on axis)',
      color: _graph.colors["driver"],
    }]
  }
}

_graph.spl_tooltip = {
  tooltip: {
    formatter: function (series_echarts) {
      // console.log(series_echarts)
      let series = [{ 
        name: "SPL",
        units: "dB",
        value: _graph.format_spl(series_echarts[0].value[1]),
        color: series_echarts[0].color } ]

      if (series_echarts[1] && series_echarts[1]["seriesName"] == "Maximum SPL") {
        series.push({
          name: "SPL<sub>max</sub>",
          units: "dB",
          value: _graph.format_spl(series_echarts[1].value[1]),
          color: series_echarts[1].color
        })
      }

      let fr = series_echarts[0].axisValue
      return _graph.tooltip(series, fr)}  },
}


_graph.spl_phase_options = () => {
  return {
    xAxis: {
      axisTick: {	show: false	},
      minorTick: { show: false },
      axisLine: { onZero: true },	},

    yAxis: {
      name: '°',
      min: _graph.scale["spl_phase"]["min"],
      max: _graph.scale["spl_phase"]["max"],
      interval: 60	// 'auto' = 100
    }, 

    series: [{
      name: 'Acoustical phase (1m, on axis)',
      color: _graph.colors["driver"],	
    }]	
  }
}

_graph.spl_phase_tooltip = {
  tooltip: {
    formatter: function (series_echarts) {
      let series = [{ 
        name: "Phase",
        units: "°",
        value: _graph.format_phase(series_echarts[0].value[1]),
        color: series_echarts[0].color } ]

      let fr = series_echarts[0].axisValue
      return _graph.tooltip(series, fr)}  },
}


_graph.group_delay_options = () => {
  return {
    yAxis: {
      name: 'ms',
      min: _graph.scale["group_delay"]["min"],
      max: _graph.scale["group_delay"]["max"],
      // interval: 5, 
    },

    series: [{
      name: 'Group Delay (1m, on axis)',		
      color: _graph.colors["driver"],				
    }]	
  }
}

_graph.group_delay_tooltip = {
  tooltip: {
    formatter: function (series_echarts) {
      let series = [{ 
        name: "Group Delay",
        units: "ms",
        value: _graph.format_group_delay(series_echarts[0].value[1]),
        color: series_echarts[0].color } ]

      let fr = series_echarts[0].axisValue
      return _graph.tooltip(series, fr)}  },
}


_graph.excursion_options = () => {
  return {
    yAxis: {
      name: 'mm',
      min: _graph.scale["excursion"]["min"],
      max: _graph.scale["excursion"]["max"],
      // interval: 5,
      },	

    series: [{
      name: 'Diaphragm Excursion',
      color: _graph.colors["driver"],	
      }]	
  }
}

_graph.excursion_tooltip = {
  tooltip: {
    formatter: function (series_echarts) {
      let series = [{ 
        name: "Excursion",
        units: "mm",
        value: _graph.format_excursion(series_echarts[0].value[1]),
        color: series_echarts[0].color } ]

      if (series_echarts[1] && series_echarts[1]["seriesName"] == "Maximum Linear Excursion") {
        series.push({
          name: "x<sub>max</sub>",
          units: "mm",
          value: _graph.format_excursion(series_echarts[1].value[1]),
          color: series_echarts[1].color
        })
      }

      let fr = series_echarts[0].axisValue
      return _graph.tooltip(series, fr)}  },
}


_graph.velocity_options = () => {
  return {
    yAxis: {
      name: 'm/s',
      min: _graph.scale["velocity"]["min"],
      max: _graph.scale["velocity"]["max"],
      // interval: 2,
      },

    series: [{
      name: 'Diaphragm Velocity',		
      color: _graph.colors["driver"],			
      }]	
  }
}

_graph.velocity_tooltip = {
  tooltip: {
    formatter: function (series_echarts) {
      let series = [{ 
        name: "Velocity",
        units: "m/s",
        value: _graph.format_velocity(series_echarts[0].value[1]),
        color: series_echarts[0].color } ]

      let fr = series_echarts[0].axisValue
      return _graph.tooltip(series, fr)}  },
}


_graph.imp_options = () => {
  return {
    yAxis: [{
      name: 'Ω',
      min: _graph.scale["elec_imp"]["min"],
      max: _graph.scale["elec_imp"]["max"],
      },{
      name: '°',
      nameTextStyle: {
        padding: [0, 0, 0, 25],
        // borderWidth: 1 ,
        // borderColor: 'red',
        fontSize: 14,
        align: 'left' },
      position: 'right',
      axisLabel: { fontSize: 14	},
      min: _graph.scale["elec_phase"]["min"],
      max: _graph.scale["elec_phase"]["max"],
      interval: 60,
      splitLine: {show: false }
      }],

    series: [{
      name: 'Electrical Impedance',
      color: _graph.colors["elec_imp"],
      yAxisIndex: 0,				// combine with SPL axis
      lineStyle: {width: 2},				
      },{
      name: 'Electrical Phase',
      color: _graph.colors["elec_phase"],
      yAxisIndex: 1,				// combine with SPL axis
      lineStyle: {width: 2},
      }]
  }
}

_graph.imp_tooltip = {
  tooltip: {
    formatter: function (series_echarts) {
      let series = [{ 
        name: "Impedance",
        units: "Ω",
        value: _graph.format_imp(series_echarts[0].value[1]),
        color: series_echarts[0].color } ]

      series.push({
        name: "Phase",
        units: "°",
        value: _graph.format_phase(series_echarts[1].value[1]),
        color: series_echarts[1].color
      })

      let fr = series_echarts[0].axisValue
      return _graph.tooltip(series, fr)}  },
}

// echart is bugget, I can't simply load the default options
// and then set `xAxis: {type: 'value'}`
_graph.time_response_options = () => {
  return {
    textStyle: _graph.default_options()['textStyle'],
    legend:    _graph.default_options()['legend'],
    grid:      _graph.default_options()['grid'],
    tooltip:   _graph.default_options()['tooltip'],

    xAxis: {
      type: 'value',
      min: 'dataMin',
      max: 'dataMax',
      minorTick: {
        show: false,
        splitNumber: 2 },
      minorSplitLine: { 
        show: false,
        lineStyle: {
          color: '#ccc',
          opacity: 0.35	} },
      axisLine: { onZero: false },
      axisLabel: {
        fontSize: 14,
        formatter: function (params) {
        return params.toString().replace(/000$/, " 000")	},},
      axisPointer: _graph.axisPointer('ms'),
      animation: false
    },

    yAxis: {
      type: 'value',
      min: function (value) {
        min = value.min
        max = value.max
        margin = (min <= max ? max : min) * 0.1
        return min - margin;
      },
      max: function (value) {
        min = value.min
        max = value.max
        margin = (min <= max ? max : min) * 0.1
        return max + margin;
      },
      nameTextStyle: {
        fontSize: 14,
        align: 'right',
        padding: [0, 8, 0, 0] },
      position: 'left',
      axisLine: { onZero: false },
      axisLabel: { 
        fontSize: 14,
        showMinLabel: false ,
        showMaxLabel: false ,
      	},
      minInterval: 0.5 ,
      maxInterval: 0.5 ,
      // splitLine: {show: false },
      // silent: true ,
      animation: false
    },
    series: [{
      color: _graph.colors["elec_imp"],
      type: 'line',
      lineStyle: {width: 1},
      symbol: 'none',
      showSymbol: false,
      animation: false,
      z: 2
    },{
      color: _graph.colors["driver"],	
      type: 'line',
      lineStyle: {width: 2},
      symbol: 'none',
      showSymbol: false,
      animation: false,
      z: 3
    }],
  }
}


_graph.time_response_tooltip = {
  tooltip: {
    formatter: function (series_echarts) {
      let series = [{ 
        name: "Input",
        units: "",
        value: _graph.format_time_response(series_echarts[0].value[1]),
        color: series_echarts[0].color } ]

      series.push({
        name: "Output",
        units: "",
        value: _graph.format_time_response(series_echarts[1].value[1]),
        color: series_echarts[1].color
      })

      let fr = series_echarts[0].axisValue
      return _graph.tooltip(series, fr, 'ms')}  },
}


_graph.transient_options = () => {
  return {
    series: [{},{
      name: 'Step response',	
      }]	
  }
}

_graph.tone_burst_options = () => {
  return {
    // The name of the serie need to be set in legend overwise, in Chrome, the name is not perfectly aligned.... seems to still be bugged :(
    legend: {
      align: 'left',
      left: 217,
    },
    series: [{}, {
      name: 'Response to a tone burst of              Hz with           cycles',	
      }]	
  }
}




_graph.initialize_all_new_graphs = () => {
  document.querySelectorAll('[data-graph-size="normal"]').forEach(function(container){
    container.querySelectorAll("[data-graph]").forEach(function(div){
      setTimeout(()=> {
        if (!div.graph) {
          div.graph = echarts.init(div, null, {renderer: 'svg'})
          // div.graph = echarts.init(div)
          let type = div.dataset.graph
          if (type == 'transient' || type == 'tone_burst') {
            div.graph.setOption(_graph.default_options())
            div.graph.setOption(_graph.time_response_options())
            div.graph.setOption(_graph[type + "_options"]())
            div.graph.setOption(_graph.time_response_tooltip)
          } else {
            div.graph.setOption(_graph.default_options())
            div.graph.setOption(_graph[type + "_options"]())
            div.graph.setOption(_graph[type + "_tooltip"])
          }
          div.querySelector("svg").style.cursor = "default"
        }
      })
    })
  })
}




const _graph_mini = {}


_graph_mini.default_options = () => {
  return {
    grid: {
      left: '0px',
      right: '2px',
      top: '0px',
      bottom: '0px',
      containLabel: true,
    },

    xAxis: {
      type: _graph.scale["fr"]["type"],
      min:  _graph.scale["fr"]["min"],
      max:  _graph.scale["fr"]["max"],
      minorTick: {
        show: false,
        splitNumber: 9
      },
      minorSplitLine: {
        show: true,
        lineStyle: {
          color: '#ccc',
          opacity: 0.35
        }
      },
      axisLine: {
        show: false
      },
      axisTick: {
        show: false
      },
      axisLabel: {
        margin: 2,
        fontSize: 8,
        showMaxLabel: false,
      },
      animation: false
    },

    yAxis: {
      interval: 10,
      // min: _graph.scale["spl"]["min"],
      // max: _graph.scale["spl"]["max"],
      axisLine: {show: false},
      axisTick: {show: false},
      axisLabel: {
        margin: 2,
        fontSize: 8,
        // showMinLabel: false,
        showMaxLabel: false,
      },
      animation: false
    },

    series: _graph.series_default_options,
  }
}


_graph_mini.spl_options = () => {
  options = _graph_mini.default_options()
  options.yAxis.min = _graph.scale["spl"]["min"]
  options.yAxis.max = _graph.scale["spl"]["max"]
  options.series[0].color = _graph.colors["driver"]
  return options
}

_graph_mini.imp_options = {}


_graph_mini.initialize_all_new_graphs = () => {
  document.querySelectorAll('[data-graph-size="mini"]').forEach(function(container){
    container.querySelectorAll('[data-graph]').forEach((div) => {
      setTimeout(()=> {
        if (!div.graph) {
          let type = div.dataset.graph
          div.graph = echarts.init(div)
          let options = _graph_mini[type + "_options"]()
          div.graph.setOption(options) 
          // div.querySelector("canvas").style.cursor = "default"
          div.querySelector("canvas").style.cursor = "pointer"
        }
      })
    })
  })
}


// _graph_mini.destroy_all = () => {
//   document.querySelectorAll('[data-graph-size="mini"]').forEach(function(container){
//     container.querySelectorAll('[data-graph]').forEach((div) => {
//       if (div.graph) {
//         div.graph.dispose()
//         div.graph = null
//       }
//     })
//   })
// }




// On startup
document.addEventListener('DOMContentLoaded', (event) => {

  _graph.load_options_from_localStorage()
  _graph.initialize_options()
  _graph.initialize_all_new_graphs()

});