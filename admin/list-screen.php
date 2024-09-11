<?php
include("admin-layouts/header.php");

// Fetch screens from the database
$sql = "SELECT s.screen_Id, s.screen_name, t.theater_name,total_seats_available
FROM screen s
LEFT JOIN theater t ON s.theater_Id = t.theater_Id";

$result = mysqli_query($conn, $sql);

if (!$result) {
    $error = "Error fetching screens: " . mysqli_error($conn);
}
?>

<main class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- main title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>List of Screens</h2>
                </div>
            </div>
            <!-- end main title -->
            
            <a href="add-screen.php" class="main__title-link">Add screen</a>
            <?php if (!empty($error)): ?>
                <div class="col-12">
                    <p class="text-danger"><?php echo $error; ?></p>
                </div>
            <?php endif; ?>


            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Screen ID</th>
                                <th>Theater</th>
                                <th>Screen Name</th>
                                <th>Total Seats</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['screen_Id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['theater_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['screen_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['total_seats_available']); ?></td>
                                   	<td>
										<div class="catalog__btns">
											<button type="button" data-bs-toggle="modal" class="catalog__btn catalog__btn--banned" data-bs-target="#modal-status">
												<i class="ti ti-lock"></i>
											</button>
											<a href="edit-screen.php?id=<?php echo $row['screen_Id']; ?>" class="catalog__btn catalog__btn--edit">
												<i class="ti ti-edit"></i>
											</a>
											<a href="delete-screen.php?id=<?php echo $row['screen_Id']; ?>" class="catalog__btn catalog__btn--delete">
												<i class="ti ti-trash"></i>
								            </a>
										</div>
									</td>

                                   
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>