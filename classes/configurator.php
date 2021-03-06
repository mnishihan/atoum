<?php

namespace mageekguy\atoum;

class configurator
{
	protected $script = null;
	protected $methods = array();

	public function __construct(scripts\runner $script)
	{
		$this->script = $script;

		foreach ($this->script->getHelp() as $help)
		{
			list($arguments, $values) = $help;

			foreach ($arguments as $argument)
			{
				$this->methods[preg_replace('/-(.)/e', 'ucfirst(\'\1\')', ltrim($argument, '-'))] = $argument;
			}
		}
	}

	public function __call($method, $arguments)
	{
		if (isset($this->methods[$method]) === false)
		{
			if (method_exists($this->script, $method) === false)
			{
				throw new exceptions\runtime\unexpectedValue('Method \'' . $method . '\' is unavailable');
			}

			call_user_func_array(array($this->script, $method), $arguments);

			return $this;
		}
		else
		{
			$this->script->getArgumentsParser()->invokeHandlers($this->script, $this->methods[$method], $arguments);

			return $this;
		}
	}

	public function getScript()
	{
		return $this->script;
	}
}
