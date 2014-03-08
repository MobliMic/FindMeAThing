</section>
<footer>
	<?php
		if (ENVIRONMENT == 'DEV') {
			$endTime    = microtime();
			$endTime    = explode(' ', $endTime);
			$endTime    = $endTime[1] + $endTime[0];
			$total_time = round(($endTime - $GLOBALS['HC_CORE']->getSite()->getStartTime()), 4);
			echo '<small>Page generated in ' . $total_time . ' seconds.</small><br>';
		}
		echo '<small>' . AUTHOR . '</small>';
	?>
</footer>
</body>
</html>