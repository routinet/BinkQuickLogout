<?php
/**
 * @package Plugin Bink's QuickLogout for Joomla! 3
 * @version 1.0.0
 * @author Steve Binkowski
 * @copyright (C) 2015 Steve Binkowski
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 *
 * A plugin for Joomla! 3.x CMS to allow for one-click logout links.
 * Requires jQuery to be loaded.
**/

defined('_JEXEC') or die;

class plgSystemQuickLogout extends JPlugin
{

  protected static $is_applied = false;

  public function __construct(&$subject, $config = array())
  {
    parent::__construct($subject,$config);
  }

  private function _generateLink()
  {
    // the URL requires a form token be present
    $token = JSession::getFormToken();

    // the routing portion of the query string, including form token
    $url = "/index.php?option=com_users&task=user.logout&{$token}=1";

    // if a return URL is requested, add it
    if ($this->params->get('usereturn'))
    {
      $url .= "&return=" . urlencode(base64_encode( $this->params->get('returnurl', '/')) );
    }

    return $url;
  }

  private function _injectJS($link)
  {
    if (!self::$is_applied)
    {
      // the optional names of the CSS class to assign, and the page's jQuery object
      $classname = $this->params->get('triggerclass', 'bink-quick-logout-link');
      $jqname    = $this->params->get('jqname',       'jQuery');

      // a simple one-line script gets injected into the document
      $content = '(function($){$(document).ready(function(){$("a.' . $classname .
                 '").attr("href","' . $link . '");});})(' . $jqname . ');';
      $doc = JFactory::getDocument();
      $doc->addScriptDeclaration($content);
      self::$is_applied = true;
    }
  }

  public function onBeforeRender($context, $article, $params, $page = 0)
  {
    $this->_injectJS($this->_generateLink());
  }
}
