// this evil language doesn't even have a simple `delete` method for Array 😱
// a = [1, 2, 2, 2, 3]
// a.delete(2)
// a // => [1, 3]
Array.prototype.delete = function (value) {
  for (let i = this.length - 1; 0 <= i; i--) {
    if (this[i] === value) {
      this.splice(i, 1)
    }
  }
}

// I always forgot the () and JS don't raise an error :(
// [1, 2, 3].first() // => 1
Array.prototype.first = function () {
  return this[0]
}
NodeList.prototype.first = function () {
  return this[0]
}

// [1, 2, 3].last() // => 3
Array.prototype.last = function () {
  return this.at(-1)
}
NodeList.prototype.last = function () {
  return this[this.length - 1]
}

// `css` is an alias for `querySelectorAll`
// Surprisingly, the JS core team didn't call it `queryCssSelectorForAllChildrenElements`
Document.prototype.css = function(selectors) {
  return this.querySelectorAll(selectors)
}
Element.prototype.css = function(selectors) {
  return this.querySelectorAll(selectors)
}

// Simple alias for console.log()
// Don't support multiple arguments
function log(param) {
  console.log(param)
}

// "10000" => "10 000"
function numbers_thousands_separators(num){
  let num_parts = num.toString().split(".");
  num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  return num_parts.join(".");
}


// Restrict the input values to int
// `min` and `max` can be negative
// <input class="int_only" min="0" max="100">
// TODO: convert this function to an object
// For floats, automaticaly convert `,` to `.` (european keyboards)
// Bug: don't accepte 0000 (10000 => 0000 => 20000)
function input_int_only(textbox) {
	/* textbox.old_value = textbox.value; */  
  textbox.addEventListener("input", function () {
  	min = parseInt(this.min)
    max = parseInt(this.max)
    int = parseInt(this.value.trim())
    // console.log("value:" + this.value)
    
    if (this.value.trim() == "-") {
    	// console.log("-")
    	if (min) {
      	this.value = (min < 0) ? "-" : "" }
      else {
      	this.value = "-" }
      this.previous_value = this.value || " "
      
    } else if (int == this.value.trim()) {
    	// console.log("int")
      if (int < min) {
        value = this.previous_value || this.old_value
        this.value = value.trim() } 
      else if (max < int) {
      	value = this.previous_value || this.old_value
        this.value = value.trim() } 
      else {
        this.value = int
        this.previous_value = int.toString() }
      
    } else if (this.value) {
    	// console.log("this.value")
      value = this.previous_value || this.old_value
      this.value = value.trim()
      
    } else {
    	// console.log("else")
      this.previous_value = " " }
  });

  textbox.addEventListener("change", function () {
  	value = this.value.trim()
  	if (value == "" || value == "-") {
    	// console.log("change")
    	this.value = this.old_value } 
  });
  
  textbox.addEventListener("focus", function () {
  	this.old_value = this.value
  });
}





class TabsContainer {
  constructor (div) {
    this.div = div
    this.tabs = div.css('[data-tab]')
    this.menu_items = div.css('[data-menu-item]')
    this.add_event_listeners()
  }

  add_event_listeners() {
    this.menu_items.forEach((item) => {
      item.addEventListener('click', (e) => {
        this.div.tabs_container.select(item)
      })
    })
  }

  select (item) {
    this.selected = item.dataset["menuItem"]
    this.update()
  }

  update() {
    this.menu_items.forEach((item) => {
      if (item.dataset["menuItem"] === this.selected) {
        item.classList.add('selected')
      } else {
        item.classList.remove('selected')
      }
    })
    
    this.tabs.forEach((tab) => {
      if (tab.dataset["tab"] === this.selected) {
        tab.classList.remove('hide')
      } else {
        tab.classList.add('hide')
      }
    })
  }
}




document.addEventListener('DOMContentLoaded', (event) => {

  document.css("input.int_only").forEach((input) => {
    input_int_only(input)
  })

  document.css('.tabs-container').forEach( div => {
    div.tabs_container = new TabsContainer( div )
  })
  
});
