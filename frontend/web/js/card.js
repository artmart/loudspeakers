const _card = {}


// Initialize switch between Photos and Graphs when the mouse enter the card.
_card.initialize_all_new_cards = function () {
  document.querySelectorAll(".woofer_card").forEach(function(card){
    if (!card.initialized_photos_and_graphs) {
      let img = card.querySelector('.photo img')
      if (img) {
        let photo1 = img.src
        let photo2 = img.dataset.photo2
        if (photo1 && photo1 != "" && photo2 && photo2 != "") {
          card.addEventListener("mouseenter", () => {
            img.src = photo2
          })
          card.addEventListener("mouseleave", () => {
            img.src = photo1
          })
        }
      }

      // let graph = card.querySelector('.graph')
      // let echart = graph.querySelector('.echart')
      // let graph_img = graph.querySelector('img')

      // if (graph_img) {
      //   graph.addEventListener("mouseenter", () => {
      //     echart.style.display = "none"
      //     graph_img.style.display = "block"
      //   })
      //   graph.addEventListener("mouseleave", () => {
      //     echart.style.display = "block"
      //     graph_img.style.display = "none"
      //   })
      // }

      card.initialized_photos_and_graphs = true
    }
  })

  // Highlight open tabs
  if (window.browser_tabs) {
    window.browser_tabs.on_change()
  }
}


// On startup
document.addEventListener('DOMContentLoaded', (event) => {

  _card.initialize_all_new_cards()
  _graph_mini.initialize_all_new_graphs()
  
});




// Track open cards
// The name of a newly initialised class NEED to be `browser_tabs`
// and to be attached to the window:
// window.browser_tabs = new BrowserTabs()

// TODO: Try to refactor with `BroadcastChannel`
class BrowserTabs {

  constructor() {
    this.storage_key  = "BrowserTabs"
    this.current_page = decodeURIComponent(window.location.pathname)
    this.add(this.current_page)

    window.addEventListener('storage', (event) => {
      if (event.key == this.storage_key) {
        this.on_change()
      }
    })

    addEventListener("focus", () => {
      this.add(this.current_page)
      this.on_change()
    })
    
    window.addEventListener('beforeunload', () => {
      this.remove(this.current_page)
    })

    this.on_change()
  }
  
  tabs() {
    return JSON.parse( localStorage.getItem( this.storage_key ) || "[]" ) 
  }

  save(tabs) {
    localStorage.setItem( this.storage_key, JSON.stringify(tabs) )
  }

  add(tab = this.current_page) {
    const tabs = this.tabs()
    if (!tabs.includes(tab)) {
      tabs.push(tab)
      this.save(tabs)
    }
  }

  remove(tab = this.current_page) {
    const tabs = this.tabs()
    tabs.delete(tab)
    this.save(tabs)
  }

  on_change() {
    // This need to be refactor with EventTarget, but the Event is not triggered when the object is constructed.
    // this.log()
    const tabs = this.tabs()
    document.css(".woofer_card").forEach((card) => {
      const href = card.querySelector("a").getAttribute('href')
      if (tabs.includes(href)) {
        card.classList.remove('closed_tab')
        card.classList.add('opened_in_a_tab')
      } else {
        if (card.classList.contains('opened_in_a_tab')) {
          card.classList.remove('opened_in_a_tab')
          card.classList.add('closed_tab')
        }
      }
    })
  }

  log() {
    console.log( `Open tabs:` )
    this.tabs().forEach ((tab) => {
      console.log( tab )
    })
  }

}



class BrowserHistory {

  constructor() {
    this.storage_key = "BrowserHistory"
    this.current_page = decodeURIComponent(window.location.pathname)

    window.addEventListener('beforeunload', () => {
      this.add()
    })

    window.addEventListener('pageshow', (event) => {
      if (event.persisted) {
        this.on_page_load()
      }
  })

    this.on_page_load()
  }

  history() {
    return JSON.parse( localStorage.getItem( this.storage_key ) || "[]" ) 
  }

  add() {
    const history = this.history()
    history.push(this.current_page)
    this.save(history)
  }

  save(history) {
    history = history.slice(-10) // keep the history short
    localStorage.setItem( this.storage_key, JSON.stringify(history) )
  }

  on_page_load() {
    const last_url = this.history().at(-1)
    if (last_url) {
      document.css(".woofer_card").forEach((card) => {
        const href = card.querySelector("a").getAttribute('href')
        if (href == last_url) {
          card.classList.remove('opened_in_a_tab')
          card.classList.remove('closed_tab')
          setTimeout(() => {
            card.classList.add('closed_tab')
          }, 0)
        }
      })
    }

    //// Highlight all tabs in history
    // this.history().forEach((url_in_history) => {
    //   if (!window.browser_tabs.tabs().includes(url_in_history)) {
    //     document.css(".woofer_card").forEach((card) => {
    //       const href = card.querySelector("a").getAttribute('href')
    //       if (href == url_in_history) {
    //         card.classList.remove('opened_in_a_tab')
    //         card.classList.remove('closed_tab')
    //         setTimeout(() => {
    //           card.classList.add('closed_tab')
    //         }, 0)
    //       }
    //     })
    //   }
    // })
  }

}


window.addEventListener('DOMContentLoaded', (event) => {
  window.browser_tabs = new BrowserTabs()
  window.browser_history = new BrowserHistory()
})
