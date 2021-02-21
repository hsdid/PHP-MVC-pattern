<?php use app\core\Application; ?>
<div class="row">
		<div class="span12 d-flex justify-content-center">
			<form class="form-horizontal" action='' method="POST">
			  <fieldset class=" text-center">
				
			    <div id="legend">
			      <legend class="">Register</legend>
			    </div>
			    <div class="control-group">
			      <!-- Username -->
			      <label class="control-label"  for="username">Username</label>
			      <div class="controls">
			        <input type="text" id="username" name="username" placeholder="" class="input-xlarge" required>
			      </div>
			    </div>
                <div class="control-group mt-2">
			      <!-- Password-->
			      <label class="control-label" for="email">Email</label>
			      <div class="controls">
			        <input type="email" id="email" name="email" placeholder="" class="input-xlarge" required>
			    <div class="control-group mt-2">
			      <!-- Password-->
			      <label class="control-label" for="password">Password</label>
			      <div class="controls">
			        <input type="password" id="password" name="password" placeholder="" class="input-xlarge" required>
			      </div>
			    </div>

				<div class="control-group mt-2">
			      <!-- Password-->
			      <label class="control-label" for="password">Confirm Password</label>
			      <div class="controls">
			        <input type="password" id="confirmPass" name="confirmPass" placeholder="" class="input-xlarge" required>
			      </div>
			    </div>

			    <div class="control-group">
			      <!-- Button -->
			      <div class="controls mt-4">
			        <button class="btn btn-success">Register</button>
			      </div>
			    </div>
			  </fieldset>
			</form>
		</div>
	</div>
