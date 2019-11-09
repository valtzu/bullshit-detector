<?php


namespace Blackbox;


use Blackbox\Detectors\AblativeGrammaticalCaseDetector;
use Blackbox\Detectors\AdessiveGrammaticalCaseDetector;
use Blackbox\Detectors\AllativeGrammaticalCaseDetector;
use Blackbox\Detectors\ElativeGrammaticalCaseDetector;
use Blackbox\Detectors\EssiveGrammaticalCaseDetector;
use Blackbox\Detectors\GenitiveGrammaticalCaseDetector;
use Blackbox\Detectors\IllativeGrammaticalCaseDetector;
use Blackbox\Detectors\InessiveGrammaticalCaseDetector;
use Blackbox\Detectors\ParticleDetector;
use Blackbox\Detectors\PartitiveGrammaticalCaseDetector;
use Blackbox\Detectors\QuestionDetector;
use Blackbox\Detectors\SuspiciousSubsequentConsonantDetector;
use Blackbox\Detectors\ToBeVerbDetector;
use Blackbox\Detectors\TranslativeGrammaticalCaseDetector;

class ScoreCalculator
{
	private string $phrase;
	private float $score;
	private array $interpretation;

	public function setPhrase(string $phrase)
	{
		$this->phrase = rtrim($phrase, '. ');
	}

	public function process()
	{
		$scores = [
			[new AblativeGrammaticalCaseDetector, 1],
			[new AdessiveGrammaticalCaseDetector, 1],
			[new AllativeGrammaticalCaseDetector, 1],
			[new ElativeGrammaticalCaseDetector, 1],
			[new EssiveGrammaticalCaseDetector, 1],
			[new GenitiveGrammaticalCaseDetector, 1],
			[new IllativeGrammaticalCaseDetector, 1],
			[new InessiveGrammaticalCaseDetector, 1],
			[new PartitiveGrammaticalCaseDetector, 1],
			[new TranslativeGrammaticalCaseDetector, 1],

			[new SuspiciousSubsequentConsonantDetector, -3],
			[new ParticleDetector, 1.2],
			[new ToBeVerbDetector, 1.5],
			[new QuestionDetector, 1.5],
		];

		$totalScore = 0;

		$output = [
			'phrase' => $this->phrase,
			'words' => [],
		];

		foreach (preg_split("/\s|\./", $this->phrase) as $word) {

			$tags = [];
			foreach ($scores as $tuple) {
				/** @var DetectorInterface $detector */
				[$detector, $score] = $tuple;

				if (!$detector->matches($word))
					continue;

				$tags[] = $detector::TAG;
				$totalScore += $score;
			}

			$output['words'] = ['word' => $word, 'tags' => $tags];
		}

		$this->interpretation = $output;
		$this->score = $totalScore / count($output);
	}

	public function getInterpretation(): array
	{
		return $this->interpretation;
	}

	public function getScore(): float
	{
		return $this->score;
	}
}