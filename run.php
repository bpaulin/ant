<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="web/style.css">
</head>
<body>
	<div class="container">
		<h1>Langton's ant</h1>

		<table class="table table-hover table-condensed">
			<thead>
				<tr>
					<th>Iteration</th>
					<th>X</th>
					<th>Y</th>
					<th>Color</th>
					<th>Angle</th>
					<th>X new</th>
					<th>Y new</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require_once('src/Ant.php');
					$ant = new Ant();
					$i = 1;
					// Start Running the Ant
					while (!$ant->isOnHighway()) {
						echo '<tr>';
						$run = $ant->run();
						echo '<td>'.$i++.'</td>';
						echo '<td>'.$run['X'].'</td>';
						echo '<td>'.$run['Y'].'</td>';
						echo '<td><div class="color '.$run['color'].'" title="'.$run['color'].'"></div></td>';
						echo '<td>'.$run['angle'].'°</td>';
						echo '<td>'.$run['Xnew'].'</td>';
						echo '<td>'.$run['Ynew'].'</td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>
