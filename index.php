<?php
require 'connect.php';
require 'functions.php';

if (!isLoggedIn()) {
	$pageTitle = "Login";
	include 'login.php';
	die();
}
$pageTitle = "Home";
include 'header.php';
?>
		<div class="time">
		<h2>Timesheets</h2>
 			    <table id="hoursTable" width="300" border="1">
				    <tr class="titlerow">
				        <th>Apple</th>
				        <th>Orange</th>
				        <th>Watermelon</th>
				        <th>Strawberry</th>
				        <th>Total By Row</th>
				    </tr>
				    <tr>
				        <td class="rowAA">1</td>
				        <td class="rowAA">2</td>
				        <td class="rowBB">3</td>
				        <td class="rowBB">4</td>
				        <td class="totalRow"></td>
				    </tr>
				    <tr>
				        <td class="rowAA">1</td>
				        <td class="rowAA">2</td>
				        <td class="rowBB">3</td>
				        <td class="rowBB">4</td>
				        <td class="totalRow"></td>
				    </tr>
				    <tr>
				        <td class="rowAA">1</td>
				        <td class="rowAA">5</td>
				        <td class="rowBB">3</td>
				        <td class="rowBB">4</td>
				        <td class="totalRow"></td>
				    </tr>
				    <tr class="totalColumn">
				        <td class="totalCol">Total:</td>
				        <td class="totalCol">Total:</td>
				        <td class="totalCol">Total:</td>
				        <td class="totalCol">Total:</td>
				        <td class="totalCol">Total:</td>
				    </tr>
				</table>
<!-- 			    <table id="hoursTable" width="300" border="1">
    <tr class="titlerow">
        <td>Apple</td>
        <td>Orange</td>
        <td>Watermelon</td>
        <td>Strawberry</td>
        <td>Total By Row</td>
    </tr>
    <tr>
        <td class="rowAA">1</td>
        <td class="rowAA">2</td>
        <td class="rowBB">3</td>
        <td class="rowBB">4</td>
        <td class="totalRow"></td>
    </tr>
    <tr>
        <td class="rowAA">1</td>
        <td class="rowAA">2</td>
        <td class="rowBB">3</td>
        <td class="rowBB">4</td>
        <td class="totalRow"></td>
    </tr>
    <tr>
        <td class="rowAA">1</td>
        <td class="rowAA">5</td>
        <td class="rowBB">3</td>
        <td class="rowBB">4</td>
        <td class="totalRow"></td>
    </tr>
    <tr class="totalColumn">
        <td class="totalCol">Total:</td>
        <td class="totalCol">Total:</td>
        <td class="totalCol">Total:</td>
        <td class="totalCol">Total:</td>
        <td class="totalCol">Total:</td>
    </tr>
</table> -->
		</div>
		<div class="notification">
			<h2>Messages</h2>
			<hr>
			<p>This is some bogus text that I'm going to place here until I can get the real thing set up. I could put in Lorem Ipsum, but that's just way too much work.</p>
		</div>
		<div class="clear"></div>
		<small><strong>Last login: </strong><?php echo getLastLogin(); ?>.</small>
<?php
include 'footer.php';
?>