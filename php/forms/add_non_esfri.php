<?php
  if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo "<div class='success-report'>Record inserted successfully</div>";
  }
  elseif (isset($_GET['err'])) {
    if($_GET['err'] == '1'){
      echo "<div class='error-report'>Invalid url format</div>";
    }
    if($_GET['err'] == '2'){
      echo "<div class='error-report'>Only letters and white space allowed</div>";
    }
  }
?>

<form action="/app_2_2/php/submit_non_esfri.php" method="post" id="non-esfri-form">
  <fieldset class="form-group">
    <legend>General Information </legend>
    <ul class="list-primary">
        <li>
          <div class="required">
            <label>Name</label>
            <input id="name" name="name" placeholder="Type Here" required autofocus>
          </div>
        </li>
        <li>
          <label>URL</label>
          <input id="url" name="url" type="url" placeholder="http://mysite.com">
        </li>
        <li>
          <div class="required">
            <label>Host</label>
            <input id="host" name="host" required>
          </div>
        </li>
        <li>
          <div class="required">
            <label>Coordinator Country</label>
            <input id="coordcountry" name="coordcountry" required>
          </div>
        </li>
        <li>
          <label>Contact</label>
          <input id="contact" name="contact">
        </li>
        <li>
          <div class="required">
            <label>Status</label>
            <input id="status" name="status" required>
          </div>
        </li>
    </ul>
  </fieldset>
  <fieldset class="form-group">
    <legend>Location Specific</legend>
    <ul class="list-primary">
      <li>
        <div class="required">
          <label>Location</label>
          <input type="text" id="location" name="location" required>
          <script src="js/RIlatlongCalculator.js"></script> 
        </div>
      </li>
      <li>
        <label>Longtitude</label>
        <input id="lng" name="lng" disabled="true">
      </li>
      <li>
        <label>Latitude</label>
        <input id="lat" name="lat" disabled="true">
      </li>
    </ul>
  </fieldset>
  <fieldset class="form-group">
    <legend>Categorization</legend>
    <ul class="list-primary">
      <li>
        <div class="required">
          <label>Domain</label>
          <select id="domain" name="domain" required>
            <option value="Biological and Medical Sciences">Biological and Medical Sciences</option>
            <option value="Chemistry and Material Sciences">Chemistry and Material Sciences</option>
            <option value="Earth and Environmental Sciences">Earth and Environmental Sciences</option>
            <option value="Engineering and Energy">Engineering and Energy</option>
            <option value="Humanities and Arts">Humanities and Arts</option>
            <option value="Social Sciences">Social Sciences</option>
            <option value="Information Science and Technology">Information Science and Technology</option>
            <option value="Physics, Astronomy, Astrophysics and Mathematics">Physics, Astronomy, Astrophysics and Mathematics</option>
          </select>
        </div>
      </li>
      <li>
        <div class="required">
          <label>Type</label>
          <?php include 'online_radio.php'; ?>
        </div>
      </li>
      <li>
        <div class="required">
          <label>RI category</label>
          <input id="ric" name="ric" required>
        </div>
      </li>
      <li>
        <label>RI keywords</label>
        <input id="rik" name="rik">
      </li>
      <li>
        <label>Description</label>
        <?php include 'online_textarea.php'; ?>
      </li>
    </ul>
  </fieldset>
</form>
<button class="btn-primary" type="submit" name="submit" form="non-esfri-form" value="Submit">Submit</button>
