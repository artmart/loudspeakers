 <?php //var_dump($vsort);?>
<div class="row"> 

<div class="col-sm-12">
    <label class="col-sm-7" for="<?=$label;?>">
        <div class="input-container">
            <input type="hidden" id="sortableInput<?=$field;?>" name="Transducers2Search[<?=$field.'_sort';?>]">
            <i class="sort-icon fa fa-sort fa-1x mb-1" id="sortIcon<?=$field;?>"></i>
        </div> 
        <strong><?=$label;?></strong>
    </label> 
           
    <div class="col-sm-5 d-grid gap-2 d-md-flex justify-content-md-end">
        <label class="d-flex justify-content-start mr-1" for="<?=$short_label;?>"><strong><?=$short_label;?></strong></label>
        <div class="d-flex align-items-center mb-1">
            <input type="number" step="1" id="input-lower<?=$field;?>" name="Transducers2Search[<?=$field.'_min';?>]" onchange='filtrsort()'>
            <input type="number" step="1" id="input-upper<?=$field;?>" name="Transducers2Search[<?=$field.'_max';?>]" onchange='filtrsort()'>
        </div>
        <strong> <?=$mesure;?></strong>
    </div>
    <div class="row1 col-sm-12"  id="my-slider<?=$field;?>"></div>

</div>
</div>

<?php


/*
    let ths<?=$field;?> = document.getElementById('sortIcon<?=$field;?>');
    if('<?=$vsort;?>'=='SORT_ASC'){
        
        ths<?=$field;?>.classList.remove('fa-sort-amount-desc');
        ths<?=$field;?>.classList.add('fa-sort-amount-asc');
    }else{
        ths<?=$field;?>.classList.remove('fa-sort-amount-asc');
        ths<?=$field;?>.classList.add('fa-sort-amount-desc');
    }

*/
?>


<script>


   document.getElementById('sortIcon<?=$field;?>').addEventListener('click', function() {
    const inputField<?=$field;?> = document.getElementById('sortableInput<?=$field;?>');

    let sortOrder = '<?=$vsort;?>'; // Manage sort state

    // Toggle sort order
    if (this.classList.contains('fa-sort-amount-asc')) {
        this.classList.remove('fa-sort-amount-asc');
        this.classList.add('fa-sort-amount-desc');
        sortOrder = 'SORT_DESC';
    } else {
        this.classList.remove('fa-sort-amount-desc');
        this.classList.add('fa-sort-amount-asc');
        sortOrder = 'SORT_ASC';
    }
    $("#sortableInput<?=$field;?>").val(sortOrder);
    // Implement sorting logic based on input value or related data
   // if (sortOrder === 'asc') {
    //    data.sort();
    //} else {
     //   data.sort().reverse();
    //}
filtrsort();
    //console.log("Sorted data:", data); // Display or update UI with sorted data
});

//////////////////////////////////////////////////////////////////////////////////////////

    var slider<?=$field;?> = document.getElementById('my-slider<?=$field;?>');
    noUiSlider.create(slider<?=$field;?>, {
        start: [0, '<?=$max;?>'], // Initial values for two handles
        connect: true,
        'step': 1,
        range: {
            'min': 0,
            'max': <?=$max;?>,  
        },
        //tooltips: [wNumb({decimals: 1}), true],
    });


    var inputLower<?=$field;?> = document.getElementById('input-lower<?=$field;?>');
    var inputUpper<?=$field;?> = document.getElementById('input-upper<?=$field;?>');

    slider<?=$field;?>.noUiSlider.on('update', function (values, handle) {
        if (handle === 0) {
            inputLower<?=$field;?>.value = values[handle];
        } else {
            inputUpper<?=$field;?>.value = values[handle];
        }
        filtrsort();
    });
    
    inputLower<?=$field;?>.addEventListener('change', function () {
        slider<?=$field;?>.noUiSlider.set([this.value, null]); // Set lower handle, upper handle unchanged
        //filtrsort();
    });

    inputUpper<?=$field;?>.addEventListener('change', function () {
        slider<?=$field;?>.noUiSlider.set([null, this.value]); // Set upper handle, lower handle unchanged
        //filtrsort();
    });
</script>