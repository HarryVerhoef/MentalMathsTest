<?

while ($row = mysqli_query(...)) {
	if ($row["TITLE"] == "" || !isset($row["TITLE"])) {
		echo "<li class='day js_modal_open' data-day-id='".$row["DAY_ID"]."' data-title='No Event' data-url='#' data-description='No Event'><div class='date'>".$row["DAY"]."</div></li>";
	} else {
		// The normal code block with the echos and shit
	};

}

?>