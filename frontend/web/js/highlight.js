const _highlight = {}


_highlight.highlighted_spec = []
// _highlight.highlighted_spec_on_chart = []
_highlight.highlighted_spec_old = []


_highlight.load_highlighted_spec = () => {
  if (localStorage['highlighted_spec']) {
    _highlight.highlighted_spec = JSON.parse(localStorage['highlighted_spec'])
  }
}

_highlight.save_highlighted_spec = () => {
  if (localStorage['highlighted_spec']) {
    _highlight.highlighted_spec_old = JSON.parse(localStorage['highlighted_spec'])
  }
  localStorage['highlighted_spec'] = JSON.stringify(_highlight.highlighted_spec)
}

_highlight.highlighted_spec_changes = () => {
  // console.log(_highlight.highlighted_spec_old)
  // console.log(_highlight.highlighted_spec)
  let removed = _highlight.highlighted_spec_old.filter(x => !_highlight.highlighted_spec.includes(x))
  let added   = _highlight.highlighted_spec.filter(x => !_highlight.highlighted_spec_old.includes(x))
  return {
    "added": added,
    "removed": removed
  }
}


_highlight.initialize_all_new_specs = () => {
  _highlight.load_highlighted_spec()

  document.querySelectorAll("[data-highlight]").forEach((span) => {
    if (!span.highlight_initialized) {
      span.addEventListener("click", () => {
        let spec = span.dataset['highlight']
        // console.log(spec)
        if (_highlight.highlighted_spec.includes(spec)) {
          let index = _highlight.highlighted_spec.indexOf(spec)
          _highlight.highlighted_spec.splice(index, 1)
        } else {
          _highlight.highlighted_spec.push(spec)
        }
        _highlight.save_highlighted_spec()
        _highlight.trigger_on_click()
      })
      span.highlight_initialized = true
      _highlight.highlight_spec(span)
    }
  })
}


_highlight.highlight_spec = (span) => {
    // console.log(span.classList)
    let spec = span.dataset['highlight']
    if (_highlight.highlighted_spec.includes(spec)) {
      span.classList.add("highlighted")
    } else {
      span.classList.remove("highlighted")
    }
}


_highlight.highlight_all_specs = () => {
  document.querySelectorAll("[data-highlight]").forEach((span) => {
    _highlight.highlight_spec(span)
  })
}


_highlight.addEventListener_for_changes_on_others_tabs = () => {
  // Alternative: StorageEvent
  // developer.mozilla.org/en-US/docs/Web/API/StorageEvent
  addEventListener('storage', (event) => {
    // console.log(event)
    if (event.key == "highlighted_spec") {
      _highlight.highlighted_spec_old  = JSON.parse(event.oldValue)
      _highlight.load_highlighted_spec()
      // console.log(_highlight.highlighted_spec_changes())
      _highlight.trigger_on_click()
    }
  })
}



_highlight.functions_to_trigger_on_click = [
  
]

_highlight.trigger_on_click = () => {
  _highlight.highlight_all_specs()
  _highlight.functions_to_trigger_on_click.forEach(fn => fn());
}



// On startup
document.addEventListener('DOMContentLoaded', (event) => {

  _highlight.initialize_all_new_specs()
  _highlight.addEventListener_for_changes_on_others_tabs()
  
});