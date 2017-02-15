<?php

ini_set("magic_quotes_gpc", "0");
ini_set("short_open_tag", "1");

session_start();

date_default_timezone_set('Europe/Paris');

define("WORK_PATH", dirname(__FILE__));
define("APP_DIR", "./");

include_once(WORK_PATH.'/../dw/dwFramework.php');

dw\dwFramework::load();

use dw\dwFramework as dw;
use dw\connectors\dbi\dbi;
use dw\classes\dwXMLConfig;
use dw\dwConnectors;
use dw\dwErrorController;
use dw\classes\dwCacheFile;
use dw\helpers\dwNumeric;
use dw\accessors\ary;
use dw\classes\dwTemplate;
use dw\classes\traducers\dwXMLTraducer;

dwErrorController::setHandler();
dwConnectors::loadConnectors(DW_CONNECTORS_DIR);
dwCacheFile::setCacheDir(DW_CACHE_DIR);
//dwPlugins::setPath(DW_PLUGINS_DIR);
dwTemplate::setWorkDir(DW_RUNTIME_DIR);
dwNumeric::setPrecision(4);

dw::loadApplication(DW_APP_NS);

if(is_dir(DW_TRADUCER_DIR.dw::getLocale()."/"))
{
	dwXmlTraducer::setdefaultDir(DW_TRADUCER_DIR.dw::getLocale()."/");
} else {
	dwXmlTraducer::setdefaultDir(DW_TRADUCER_DIR.dw::App() -> getLang()."/");
}

/* En mode debug, les templates ne sont pas mis en cache par d馡ut */
dwTemplate::setDefaultCaching(false); //!dw::isDebug()
dwCacheFile::setUseCache(!dw::isDebug());
dwXmlTraducer::setDefaultCaching(!dw::isDebug());
dbi::prepare(dw::isDebug()?DBI_MODE_DEBUG:DBI_MODE_RELEASE);
dbi::setCachingEntityDef(!dw::isDebug(), DW_DBI_ENTITYDEF_DIR);

dw::App() -> prepare();

/* Fonctions utilisées pour les inclusions de fichiers */

/**
 * Inclure un fichier librairie
 * @param $className librairie ࠩà inclure (sans l'extension du fichier)
 * Le fichier sera cherche ans le répertoire défini par la constante DW_BASE_DIR
 */
function dw_require($className) 
{
  return include_once(DW_BASE_DIR.$className.'.php');
}

function is_assoc($ary) {
       
    return !is_seq($ary);
}

function is_seq($ary) {
       
    return is_array($ary) && is_numeric(implode(array_keys($ary)));
}

function is_strict_assoc($ary) {
    return is_array($ary) && (count(array_filter(array_keys($ary), "is_numeric")) == 0);
}

?>