
<?php 
$sql_theater = "SELECT * FROM theater";
$theaters = mysqli_query($conn, $sql_theater);



?>
<div class="section section--notitle">
		<div class="container">    
			<div class="row">
				<!-- plan -->
				<div class="col-10">
					<div class="plan">
						<h3 class="plan__title"> Show Availabilty</h3>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $movie_id; ?>" method="post" class="sign__form sign__form--comments">
                        <select class="form-select text-light " aria-label="Default select example" name="theater" style="background-color: #222028; border-color: #f9ab00;">
                        <option value="">Select theater</option>
                                            <?php while ($thet = mysqli_fetch_assoc($theaters)) { ?>
                                                <option value="<?php echo $thet['theater_id']; ?>"><?php echo $thet['theater_name']; ?></option>
                                            <?php } ?>
                            </select>  
                            <input type="submit"  name="submit"  value="submit" class="plan__btn">
                        </form>
					</div>
				</div>
         </div>
	</div>

<?php 
if(isset($_POST['submit'])){
    $theater=$_POST['theater'];
  $sql_book ="SELECT * FROM shows AS sho 
  JOIN screen AS screen ON sho.screen_id = screen.screen_id
  JOIN theater AS th ON screen.theater_id = th.theater_id
  JOIN show_timing AS st ON sho.show_time_id = st.show_time_id
  JOIN movies AS m ON sho.movie_id = m.movie_id WHERE theater_name=$theater";
  $th= mysqli_query($conn,$sql_book);
if($th){ 
    
    ?>

<div class="section section--notitle">
		<div class="container">
			<div class="row">
				<!-- plan -->
				<div class="col-10 ">
					<div class="plan">
						<h3 class="plan__title"> Show Availabilty</h3>
                        <?php
                        $srno=1;
                        while($theaters= mysqli_fetch_assoc($th)) 
                        {
                        ?>                       
						<table class="table table-striped">
      <tr>
        <th>Theater</th>
        <td><?php echo $theater['theater_name'] ?></th>
      </tr>
  </table>
						<a href="signin.html" class="plan__btn">Register</a>
					</div>
				</div>

<?php 
}
}
}
?>