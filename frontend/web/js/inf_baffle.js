const _inf_baffle = {}


// highlight a specific curve
// _inf_baffle.highlight_curve("xmax", "show") 
// _inf_baffle.highlight_curve("xmax", "hide") 
_inf_baffle.highlight_curve = function (parameter, visiblity = "show") {
  if (parameter == "spl1w") { parameter = "spl" }
  document.querySelectorAll('[data-enclosure-type="inf_baffle"] [data-graph]').forEach((div) => {
    // `setTimeout` executes each block one after the other, not simultaneously.
    // Each line will be drawn successively instead of waiting for all lines to be calculated and then drawn. Improve user experience by avoiding freezes.
    setTimeout(()=> {
      let graph = div.dataset.graph
      let size  = div.parentElement.dataset.graphSize
      let line_width = 0
      let opacity    = 0
      if (!div.highlighted_curves) {
        div.highlighted_curves = []
      }
      let highlight_already_down = 
        (visiblity == "show" && !div.highlighted_curves.includes(parameter)) || 
        (visiblity == "hide" &&  div.highlighted_curves.includes(parameter)) ? 
        false : true

      if (parameter == "xmax" || parameter == "pmax") {
        line_width = visiblity == "show" ? (size == 'mini' ? 2 : 3) : 0
      } else if (parameter == "fs" || parameter == "spl" || parameter == "re") {
        line_width = visiblity == "show" ? 1 : 0
      } else if (parameter == "fr") {
        opacity    = visiblity == "show" ? 0.2 : 0
      } else if (parameter == "z") {
        line_width = visiblity == "show" ? 1 : 0
        opacity    = visiblity == "show" ? 0.2 : 0
      } else {
        line_width = visiblity == "show" ? (size == 'mini' ? 3.4 : 4) : 0
      }

      if (!highlight_already_down) {
        if (parameter == "xmax" && graph == 'spl') {
          div.graph.setOption(
            {series: [
              {},
              {},
              {lineStyle: { width: line_width}},
            ] })
        } else if (parameter == "pmax" && graph == 'spl'){
          div.graph.setOption(
            {series: [
              {},
              {},
              {},
              {lineStyle: { width: line_width}},
            ] })
        } else if (parameter == "spl" && graph == 'spl'){
          div.graph.setOption(
            {series: [
              {},
              {},
              {},
              {},
              {lineStyle: { width: line_width}},
            ] })
        } else if (parameter == "fr" && graph == 'spl'){
            div.graph.setOption(
              {series: [
                {},
                {},
                {},
                {},
                {},
                {},
                {},
                {},
                {areaStyle: {opacity: opacity}},
              ] })
        } else if (parameter == "qts"){
          if (graph == 'spl') {
            div.graph.setOption(
              {series: [
                {},
                {},
                {},
                {},
                {},
                {},
                {lineStyle: { width: line_width}},
              ] })
          } else if (graph == 'imp') {
            div.graph.setOption(
              {series: [
                {},
                {},
                {},
                {lineStyle: { width: line_width}},
              ] })
          }
        } else if (parameter == "le"){
          if (graph == 'spl') {
            div.graph.setOption(
              {series: [
                {},
                {},
                {},
                {},
                {},
                {},
                {},
                {lineStyle: { width: line_width}},
              ] })
          } else if (graph == 'imp') {
            div.graph.setOption(
              {series: [
                {},
                {},
                {},
                {},
                {lineStyle: { width: line_width}},
              ] })
          }  
        } else if (parameter == "re" && graph == 'imp'){
          div.graph.setOption(
            {series: [
              {},
              {},
              {},
              {},
              {},
              {lineStyle: { width: line_width}},
            ] })
        } else if (parameter == "z" && graph == 'imp'){
          div.graph.setOption(
            {series: [
              {},
              {},
              {},
              {},
              {},
              {},
              { lineStyle: { width: line_width},
                areaStyle: {opacity: opacity}},
            ] })
        } else if (parameter == "fs"){
          if (graph == 'spl') {
            div.graph.setOption(
              {series: [
                {},
                {},
                {},
                {},
                {},
                {lineStyle: { width: line_width}},
              ] })
          } else if (graph == 'imp') {
            div.graph.setOption(
              {series: [
                {},
                {},
                {lineStyle: { width: line_width}},
              ] })
          } else if (graph == 'spl_phase') {
            div.graph.setOption(
              {series: [
                {},
                {lineStyle: { width: line_width}},
              ] })
          } else if (graph == 'group_delay') {
            div.graph.setOption(
              {series: [
                {},
                {lineStyle: { width: line_width}},
              ] })
          } else if (graph == 'velocity') {
            div.graph.setOption(
              {series: [
                {},
                {lineStyle: { width: line_width}},
              ] })
          } else if (graph == 'excursion') {
            div.graph.setOption(
              {series: [
                {},
                {},
                {lineStyle: { width: line_width}},
              ] })
          }
        }

        if (div.highlighted_curves.includes(parameter)) {
          div.highlighted_curves.delete(parameter)
        } else {
          div.highlighted_curves.push(parameter)
        }
      }

    })
  })
}


// Highlight all curves from localStorage
_inf_baffle.highlight_selected_curves = (type = "on_change") => {
  if (type == "on_update") {
    _highlight.highlighted_spec.forEach((parameter) => {
      _inf_baffle.highlight_curve(parameter, "show")
    })
  } else { // "on_change" (should alwayse be the default because the function is called from an array without any parameters)
    let changes = _highlight.highlighted_spec_changes()
    // console.log(changes)
    changes["added"].forEach((parameter) => {
      _inf_baffle.highlight_curve(parameter, "show")
    })
    changes["removed"].forEach((parameter) => {
      _inf_baffle.highlight_curve(parameter, "hide")
    })
  }
}



_inf_baffle.fetch_json = function (force_overwrite = false) {
  let data_array = []
  const listings = document.querySelectorAll('[data-enclosure-type="inf_baffle"]');
  //console.log(listings); 
  
  listings.forEach((div) => {
	  
	 
    if (!div.graph_data || force_overwrite) {
      let size = div.dataset.graphSize
      let scale = { ..._graph.scale["fr"] } // /!\ objects are passed by reference
          scale['steps_nb'] = (size == 'mini') ? 216 : _graph.scale["fr"]['steps_nb']
      let d = {
        id:            parseInt(div.dataset.wooferId),
        graphSize:     size,
        woofer:        JSON.parse(div.dataset.woofer),
        amplifier:     _amplifier,
        scale:         scale,
        time_response: _graph.scale["time_response"],
      }
      data_array.push(d)
    }
  })
 
  data_request = {"inf_baffles": data_array}
  // console.log(data_request)
  

  fetch("/site/api", {  ///api/simulators/infinite_baffle
    method: 'POST',
    headers: {'Content-Type': 'application/json;charset=utf-8',},
    body: JSON.stringify(data_request),
	
	//boady: JSON.stringify( dadad),
	
  })
  .then((response) => response.json())
  .then((data_from_json) => {
    // console.log(data_from_json)
    _inf_baffle.attach_data_to_div(data_from_json)
    _inf_baffle.add_ghost_curve_to_data(data_from_json)
    _inf_baffle.draw_the_curves(force_overwrite)
    // When the connexion is free, load the rest of photos and graphs
    // TODO: intgrate this function to Carousel and GraphsFiles objects
    setTimeout(()=> {
      document.css('.carousel img, .measured img').forEach( img => {
        img.loading = "eager"
      })
    })
  })
  .catch((error) => {
    console.error('Error fetching data for infinite_baffle:', error)
  });
}



_inf_baffle.attach_data_to_div = (data_from_json) => {
  data_from_json["inf_baffles"].forEach((data) => {
    document.querySelectorAll('[data-enclosure-type="inf_baffle"][data-woofer-id="'+ data.id +'"][data-graph-size="'+ data.graphSize +'"]').forEach((div) => {
      div.graph_data = data
    })
  })
}

_inf_baffle.add_ghost_curve_to_data = (data_from_json) => {
  let ghost_curve = document.querySelector('.inf_baffle [data-graph-size="normal"]')?.graph_data.spl
  // log(ghost_curve)
  if (ghost_curve) {
    data_from_json["inf_baffles"].forEach((data) => {
      if (data.graphSize == 'mini') {
        document.querySelectorAll('[data-enclosure-type="inf_baffle"][data-woofer-id="'+ data.id +'"][data-graph-size="'+ data.graphSize +'"]').forEach((div) => {
          div.graph_data['ghost_curve'] = ghost_curve
          // console.log(div)
        })
      }
    })
  }
}


_inf_baffle.draw_the_curves = (force_overwrite = false) => {
  document.querySelectorAll('[data-enclosure-type="inf_baffle"]').forEach((div_inf_baffle) => {
    let data = div_inf_baffle.graph_data
    if (data && !div_inf_baffle.drawn_curves || data && force_overwrite) {
      setTimeout(()=> {
        data = div_inf_baffle.graph_data
        let graph_fs = {
          data: data["fs"],
          color: _graph.colors["elec_imp"],	
          lineStyle: {
            type: 'dashed',
            width: 0,}, }
        let graph_spl_spl1w = {
          data: data["spl1w"],
          color: _graph.colors["driver"],
          lineStyle: {
            type: 'dashed',
            width: 0,
            opacity: 1,}, }
        let graph_spl_spl_qts = {
          data: data["spl_qts"],
          color: _graph.colors["driver"],	
          lineStyle: {
            width: 0,
            opacity: 0.8,
            cap: 'round',},}
        let graph_spl_spl_le = {
          data: data["spl_le"],
          color: _graph.colors["driver"],	
          lineStyle: {
            width: 0,
            opacity: 0.8,
            cap: 'round',},}
        let graph_spl_fr = {
          data: data["fr"],
          color: _graph.colors["driver"],	
          lineStyle: { width: 0,},
          areaStyle: { opacity: 0,}  }

        let graph_ghost_curve = null
        if (data["ghost_curve"]) {
          graph_ghost_curve = {
            data: data["ghost_curve"],
            color: 'black',
            lineStyle: { 
              width: 1,
              opacity: 0.3}
          }
        } else {
          graph_ghost_curve = 
            { name: '', data: null}
        }
        
  
        div_inf_baffle.querySelectorAll('[data-graph]').forEach((div) => {
          let type = div.dataset.graph
          switch (type) {
            case "spl":
              if (data["spl_max"][0]) {
                div.graph.setOption({
                  series: [
                    { data: data["spl"],
                      color: _graph.colors["driver"]},
                    { name: 'Maximum SPL',
                      data: data["spl_max"],
                      color: _graph.colors["max"],	},
                    { data: data["spl_xmax"],
                      color: _graph.colors["max"],	
                      lineStyle: {
                        width: 0,
                        opacity: 1,
                        cap: 'round',}, },
                    { data: data["spl_pmax"],
                      color: _graph.colors["max"],	
                      lineStyle: {
                        width: 0,
                        opacity: 1,
                        cap: 'round'}, },
                    graph_spl_spl1w,
                    graph_fs,
                    graph_spl_spl_qts,
                    graph_spl_spl_le,
                    graph_spl_fr,
                    graph_ghost_curve
                  ] })
              } else {
                div.graph.setOption({
                  series: [
                    { data: data["spl"],
                      color: _graph.colors["driver"]},
                    { name: '', data: null},
                    { name: '', data: null},
                    { name: '', data: null},
                    graph_spl_spl1w,
                    graph_fs,
                    graph_spl_spl_qts,
                    graph_spl_spl_le,
                    graph_spl_fr,
                    graph_ghost_curve
                  ] })
              }
            break

            case 'imp':
              div.graph.setOption({
                series: [
                  { data: data["elec_imp"],
                    color: _graph.colors["elec_imp"],},
                  { data: data["elec_phase"],
                    color: _graph.colors["elec_phase"],},
                  graph_fs,
                  { data: data["elec_imp_qts"],
                    color: _graph.colors["elec_imp"],	
                    lineStyle: {
                      width: 0,
                      opacity: 0.8,
                      cap: 'round',},},
                  { data: data["elec_imp_le"],
                    color: _graph.colors["elec_imp"],	
                    lineStyle: {
                      width: 0,
                      opacity: 0.8,
                      cap: 'round',},},
                  { data: data["re"],
                    color: _graph.colors["elec_imp"],	
                    lineStyle: {
                      type: 'dashed',
                      width: 0,}, },
                  { data: data["z"],
                    color: _graph.colors["elec_imp"],
                    lineStyle: {width: 0, opacity: 0.4 },
                    areaStyle: {opacity: 0 }  },
                ] })
            break

            case 'spl_phase':
              div.graph.setOption({
                series: [
                  { data: data["spl_phase"],
                    color: _graph.colors["driver"]},
                  graph_fs
                ] })
            break

            case 'group_delay':
              div.graph.setOption({
                series: [
                  { data: data["group_delay"],
                    color: _graph.colors["driver"]},
                  graph_fs
                ] })
            break

            case 'excursion':
              if (data["xmax"][0]) {
                div.graph.setOption({
                  series: [
                    { data: data["excursion"],
                      color: _graph.colors["driver"]},
                    { name: 'Maximum Linear Excursion',
                      color: _graph.colors["max"],	
                      data: data["xmax"] },
                    graph_fs
                  ] })
              } else {
                div.graph.setOption({
                  series: [
                    { data: data["excursion"],
                      color: _graph.colors["driver"]},
                    { name: '',
                      data: null},
                    graph_fs
                  ] })
              }
            break

            case 'velocity':
              div.graph.setOption({
                series: [
                  { data: data["velocity"],
                    color: _graph.colors["driver"]},
                  graph_fs
                ] })
            break

            case 'transient':
              div.graph.setOption({
                series: [
                  { data: data["transient_in"],
                    color: _graph.colors["elec_imp"],},
                  { data: data["transient_out"],
                    color: _graph.colors["driver"]},
                ] })
            break

            case 'tone_burst':
              div.graph.setOption({
                series: [
                  { data: data["tone_burst_in"],
                    color: _graph.colors["elec_imp"],},
                  { data: data["tone_burst_out"],
                    color: _graph.colors["driver"]},
                ] })
            break
          }

          // reset highlighted curves
          div.highlighted_curves = []
        })

        div_inf_baffle.drawn_curves = true
      })
    }
  })

  _inf_baffle.highlight_selected_curves("on_update")
}



// On startup
document.addEventListener('DOMContentLoaded', (event) => {

  _inf_baffle.fetch_json()

  _highlight.functions_to_trigger_on_click.push(
    _inf_baffle.highlight_selected_curves
  )
  
});