
<!--map filters menu-->
<div class="r-menu map-filters-menu">
  <?php
  $btn_styles = array('fil1'=>'Filter_1',
      'fil2'=>'Filter_2', 'fil3'=>'Filter_3',
      'fil4'=>'Filter_4', 'fil15'=>'Filter_5',
      'fil6'=>'Filter_6','fil17'=>'Filter_7');

  echo "<p class='btn-style'>Choose Filter :</p>";
  echo "<select id='btn-style' class='select-primary select-filter' multiple='multiple' style='float:left'>";
  foreach($btn_styles as $cls => $option) {
      echo "<option value='$cls'>$option</option>";
  }
  echo "</select>";
  ?>
</div>
