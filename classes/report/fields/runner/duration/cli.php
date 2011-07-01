<?php

namespace mageekguy\atoum\report\fields\runner\duration;

use
	\mageekguy\atoum,
	\mageekguy\atoum\report
;

class cli extends report\fields\runner\duration
{
	const defaultPrompt = '> ';

	protected $prompt = '';

	public function __construct(atoum\locale $locale = null, $prompt = null)
	{
		parent::__construct($locale);

		if ($prompt === null)
		{
			$prompt = static::defaultPrompt;
		}

		$this
			->setPrompt($prompt)
		;
	}

	public function setPrompt($prompt)
	{
		$this->prompt = (string) $prompt;

		return $this;
	}

	public function getPrompt()
	{
		return $this->prompt;
	}

	public function __toString()
	{
		$string = $this->prompt;

		if ($this->value === null)
		{
			$string .= $this->locale->_('Running duration: unknown.');
		}
		else
		{
			$string .= sprintf($this->locale->__('Running duration: %4.2f second.', 'Running duration: %4.2f seconds.', $this->value), $this->value);
		}

		$string .= PHP_EOL;

		return $string;
	}
}

?>