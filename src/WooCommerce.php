<?php

/**
 * @file
 * Contains \Netzstrategen\Gallerya\WooCommerce.
 */

namespace Netzstrategen\Gallerya;

/**
 * WooCommerce integration.
 */
class WooCommerce {

  /**
   * Adds woocommerce specific settings.
   *
   * @implements woocommerce_get_settings_gallerya
   */
  public static function woocommerce_get_settings_gallerya(array $settings): array {
    $settings[] = [
      'type' => 'title',
      'name' => __('Product thumbnails slider settings', Plugin::L10N),
    ];
    $settings[] = [
      'type' => 'checkbox',
      'id' => '_' . Plugin::L10N . '_product_thumbnail_slider_enabled',
      'name' => __('Enable thumbnails slider for all product image galleries', Plugin::L10N),
    ];
    $settings[] = [
      'type' => 'checkbox',
      'id' => '_' . Plugin::L10N . '_product_thumbnail_slider_bullet_nav_enabled',
      'name' => __('Use bullets instead of thumbnails', Plugin::L10N),
    ];
    $settings[] = [
      'type' => 'sectionend',
      'id' => Plugin::L10N,
    ];
    return $settings;
  }


  /**
   * Adds data-srcset and data-sizes attributes to the wrapper to make images reponsive in lightGallery.
   *
   * Also adds data-sizes attributes to the image wrapper, so images are not
   * enlarged more than the original size ('full').
   *
   * @see https://sachinchoolur.github.io/lightGallery/demos/responsive.html
   *
   * @implements woocommerce_single_product_image_thumbnail_html
   */
  public static function woocommerce_single_product_image_thumbnail_html($html, $thumbnail_id) {
    $srcset = wp_get_attachment_image_srcset($thumbnail_id, 'shop_single');
    $srcsizes = wp_get_attachment_image_sizes($thumbnail_id, 'full');
    return preg_replace('/(<a\s+)/i', '<a data-srcset="' . $srcset . '" data-sizes="' . $srcsizes . '" ', $html);
  }

}
