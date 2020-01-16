<?php

namespace Drupal\simple_ajax\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Class AjaxController.
 *
 * @package Drupal\simple_ajax\Controller
 */
class AjaxController extends ControllerBase {

  /**
   * @return mixed
   */
  public function ajax() {
    $item = [
      'Black',
      'White',
      'Gray',
      'Red',
      'Orange',
      'Yellow',
      'Green',
      'Light Blue',
      'Dark Blue',
      'Purple',
      'Pink',
      'Brown',
    ];
    $content['list'] = [
      '#theme' => 'item_list',
      '#list_type' => 'ul',
      '#items' => $item,
      '#attributes' => ['class' => 'ajax_list'],
      '#wrapper_attributes' => ['class' => 'container'],
    ];

    $content['ajax_link'] = [
      '#type' => 'link',
      '#title' => $this->t('Magic is here'),
      '#attached' => ['library' => ['core/drupal.ajax']],
      '#attributes' => ['class' => ['use-ajax']],
      '#url' => Url::fromRoute('simple_ajax.ajax_link_callback'),
    ];
    return $content;
  }

  /**
   * @return \Drupal\Core\Ajax\AjaxResponse
   */
  public function AjaxLinkCallback() {

    $response = new AjaxResponse();

    /**
     * Custom random rgb color function.
     */
    function rgb_random() {
      return 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')';
    }

    $selector = '.ajax_list';
    $css = [
      'color' => rgb_random(),
    ];
    $response->addCommand(new CssCommand($selector, $css));
    return $response;
  }

}
