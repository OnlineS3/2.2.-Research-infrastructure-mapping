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
    if($_GET['err'] == '3'){
      echo "<div class='error-report'>Roadmap Entry date is not in range 1900-2099</div>";
    }
    if($_GET['err'] == '4'){
      echo "<div class='error-report'>Operation Start date is not in range 1900-2099</div>";
    }
  }
?>

<form action="/app_2_2/php/submit_esfri.php" method="post" id="esfri-form">
  <fieldset class="form-group">
    <legend>General Information </legend>
    <ul class="list-primary">
        <li>
          <div class="required">
            <label>Name</label>
            <input id="nameESFRI" name="nameESFRI" placeholder="Type Here" required autofocus>
          </div>
        </li>
        <li>
        <div class="required">
          <label>Website</label>
          <input id="websiteESFRI" name="websiteESFRI" type="url" placeholder="http://mysite.com" required autofocus>
          </div>
        </li>
        <li>
          <div class="required">
            <label>Coordinator Country</label>
            <input id="coordcountryESFRI" name="coordcountryESFRI" required>
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
          <input  type="text" id="locationESFRI" name="locationESFRI" required>
          <script src="js/ESFRIlatlongCalculator.js"></script> 
        </div>
      </li>
      <li>
        <label>Longtitude</label>
        <input id="lngESFRI" name="lngESFRI" disabled="true">
      </li>
      <li>
        <label>Latitude</label>
        <input id="latESFRI" name="latESFRI" disabled="true">
      </li>
    </ul>
  </fieldset>
  <fieldset class="form-group">
    <legend>Categorization</legend>
    <ul class="list-primary">
      <li>
        <div class="required">
          <label>Domain</label>
          <select id="domainESFRI" name="domainESFRI" required>
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
          <?php include 'online_radioESFRI.php'; ?>
        </div>
      </li>
      <li>
        <label>Description</label>
        <textarea rows="8" cols="74" class="textarea-primary" id="descriptionESFRI" name="descriptionESFRI" placeholder="Description of the ESFRI project"></textarea>
      </li>
    </ul>
  </fieldset>
  <fieldset class="form-group">
    <legend>ESFRI Specific</legend>
    <fieldset class="form-group">
      <legend>Operational</legend>
      <ul class="list-primary">
        <li>
          <div class="required">
            <label>Headquarters</label>
            <input id="hqESFRI" name="hqESFRI" required>
          </div>
        </li>
        <li>
          <label>Members</label>
          <input id="membersESFRI" name="membersESFRI" placeholder="e.g. EL, BE">
        </li>
        <li>
          <label>Partners</label>
          <input id="partnersESFRI" name="partnersESFRI" placeholder="e.g. FI, ES">
        </li>
        <li>
          <div class="required">
            <label>Roadmap Entry</label>
            <input id="roadmapESFRI" name="roadmapESFRI">
          </div>
        </li>
        <li>
          <div class="required">
            <label>Operation Start</label>
            <input id="opStartESFRI" name="opStartESFRI" placeholder="e.g. 2016" required>
          </div>
        </li>
        <li>
          <div class="required">
            <label>Preparation Cost (M €)</label>
            <input id="prepCostESFRI" name="prepCostESFRI" placeholder="e.g. 2" required>
          </div>
        </li>
        <li>
          <div class="required">
            <label>Construction Cost (M €)</label>
            <input id="constCostESFRI" name="constCostESFRI" required>
          </div>
        </li>
        <li>
          <div class="required">
            <label>Operation Cost (M €)</label>
            <input id="opCostESFRI" name="opCostESFRI" required>
          </div>
        </li>
      </ul>
    </fieldset>
    <fieldset class="form-group">
      <legend>About</legend>
      <ul class="list-primary">
        <div class="required">
          <label>ESFRI Type</label>
          <?php include 'online_radioESFRI_type.php'; ?>
        </div>
        <li>
          <label>Background</label>
          <textarea rows="8" cols="74" class="textarea-primary" id="backgroundESFRI" name="backgroundESFRI" placeholder="only for ESFRI projects"></textarea>
        </li>
        <li>
          <label>Steps</label>
          <textarea rows="8" cols="74" class="textarea-primary" id="stepsESFRI" name="stepsESFRI" placeholder="only for ESFRI projects"></textarea>
        </li>
        <li>
          <label>Activity</label>
          <textarea rows="8" cols="74" class="textarea-primary" id="activityESFRI" name="activityESFRI" placeholder="only for ESFRI landscapes"></textarea>
        </li>
        <li>
          <label>Impact</label>
          <textarea rows="8" cols="74" class="textarea-primary" id="impactESFRI" name="impactESFRI" placeholder="only for ESFRI landscapes"></textarea>
        </li>
      </ul>
    </fieldset>
  </fieldset>
</form>
<button class="btn-primary" type="submit" name="submit" form="esfri-form" value="Submit">Submit</button>
