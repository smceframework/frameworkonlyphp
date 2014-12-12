<?php

namespace Smce\Extension;

class SmTracy{
	
	public function register(){
		require __DIR__ . '/SmTracy/IBarPanel.php';
		require __DIR__ . '/SmTracy/Bar.php';
		require __DIR__ . '/SmTracy/BlueScreen.php';
		require __DIR__ . '/SmTracy/DefaultBarPanel.php';
		require __DIR__ . '/SmTracy/Dumper.php';
		require __DIR__ . '/SmTracy/FireLogger.php';
		require __DIR__ . '/SmTracy/Helpers.php';
		require __DIR__ . '/SmTracy/Logger.php';
		require __DIR__ . '/SmTracy/Debugger.php';
		require __DIR__ . '/SmTracy/OutputDebugger.php';
		require __DIR__ . '/shortcuts.php';
	}
}
