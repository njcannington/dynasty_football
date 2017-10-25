<?php

spl_autoload_register();

const ROOT = __DIR__;
const VIEWS = ROOT."/app/views";
const CONTROLLERS = ROOT."/app/controllers";
const MODELS = ROOT."/app/models";

require_once(ROOT."/vendor/autoload.php");//used for phpunit
