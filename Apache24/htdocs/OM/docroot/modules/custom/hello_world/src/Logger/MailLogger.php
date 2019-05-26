<?php
namespace Drupal\hello_world\Logger;

use Drupal\Core\Logger\LogMessageParserInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Logger\RfcLogLevel;
use Drupal\Core\Logger\RfcLoggerTrait;
use Psr\Log\LoggerInterface;

/**
 * A Logger that sends an email when the log type is "error".
 */

class MailLogger implements LoggerInterface{

/**
 * @var \Drupal\Core\Logger\LogMessageParserInterface
 */
protected $parser;

/**
 * @var \Drupal\Core\Config\ConfigFactoryInterface
 */
protected $configFactory;

/**
 * MailLogger constructor.
 *
 * @param \Drupal\Core\Logger\LogMessageParserInterface $parser
 * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
 */

  use RfcLoggerTrait;

  public function __construct(LogMessageParserInterface $parser,ConfigFactoryInterface $configFactory){
    $this->parser = $parser;
    $this->configFactory = $configFactory;
  }
  /**
   * {@inheritdoc}
   */
  public function log($level,$message,array $context = array()){
    if($level !== RfcLogLevel::ERROR){
      return;
    }

    $to = $this->configFactory->get('system.site')->get('mail');
    $langcode = $this->configFactory->get('system.site')->get('langcode');
    $variables = $this->parser->parseMessagePlaceholders($message,$context);
    $markup = new FormattableMarkup($message,$variables);
    \Drupal::service('plugin.manager.mail')->mail('hello_world','hello_world_log',$to,$langcode,['message' => $markup]);
  }
}
