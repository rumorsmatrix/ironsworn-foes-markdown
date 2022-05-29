<?php

$text = file_get_contents('foes.json');
$json = json_decode($text, true);

foreach ($json['Categories'] as $category) {

	mkdir($category['Name']);

	foreach ($category['Foes'] as $foe) {

		$html = "# {$foe['Name']}\n\n"
			. "## Description\n"
			. "{$foe['Description']}\n"
			. "\n"

			. "## {$category['Name']}\n"
			. "{$category['Description']}\n"
			. "\n";

		foreach (['Features', 'Drives', 'Tactics'] as $k) {
			$html .= "## {$k}\n";
			foreach ($foe[$k] as $e) {
				$html .= " - {$e}\n";
			}
			$html .= "\n";
		}

		$html .= "## Quest\n"
			. "{$foe['Quest']}\n"
			. "\n";

		$html .= "\n\n";

		echo $html;
		file_put_contents($category['Name'] . '/' . $foe['Name'] . ".md", $html);
	}
}


