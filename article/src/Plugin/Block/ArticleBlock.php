<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\ArticleBlock.
 */

namespace Drupal\article\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Session\AccountProxyInterface;


/**
 * Provides a 'article' block.
 *
 * @Block(
 *   id = "article_block",
 *   admin_label = @Translation("Article block"),
 *   category = @Translation("Custom article block example")
 * )
 */
class ArticleBlock extends BlockBase {
  public function build(){
    $database = \Drupal::database();
    $query = $database->select('node_field_data','n');
    
    
    /** $query->addTag('node access');
    $query->condition('n.uid', \Drupal::currentUser()->id());
    $query->condition('n.status', 1);*/
    
    
    $query->addExpression('COUNT(*)');  
    $result = $query->execute()->FetchField();
    echo "$result";
    return [
    '#theme' => 'my_template',
    '#test_var' => $result,
    '#cache' => ['max-age'=>0,
    ],
    ];

  }
}
