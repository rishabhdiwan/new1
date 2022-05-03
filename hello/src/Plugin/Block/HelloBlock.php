<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Session\AccountProxyInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello",
 *   admin_label = @Translation("Hello block"),
 *   category = @Translation("Hello"),
 * )
 */
class HelloBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        $database =\Drupal::database();
        $query = $database->select('node_field_data', 'n');
        $query->join('users_field_data', 'u', 'n.promote = u.uid');
        // $query->join('node__body', 'nb', 'nb.entity_id = n.uid');
        $query->join('node__field_image', 'nbf', 'nbf.deleted = n.promote');
        $query->fields('n', ['nid', 'title']);
        $query->fields('u', ['uid']);
        // $query->fields('nb', ['entity_id', 'body_value']);
        $query->fields('nbf', ['deleted', 'field_image_alt']);
        $query->condition('n.uid', \Drupal::currentUser()->id());
        $query->orderBy('n.created', 'DESC');
        $query->condition('n.status' ,1);
        $query->range(0, 3);
        $threenodes = $query->execute()->FetchAll();
        // echo "<pre>";
        // print_r($threenodes);
        // die();  

        $data = [];
        foreach($threenodes as $key => $value){
           $data[$key]['nid'] = $value->nid;

           $data[$key]['title'] = $value->title;

          //  $data[$key]['entity_id'] = $value->body_value;

           $data[$key]['field_image_alt'] = $value->field_image_alt;
         }

        $header =array('nid', 'title', 'field_image_alt');
        //  $header = [
        //     'title' => t('title'),
        //     'body' => t('body'),
        //   ];
          
          $build['table'] = [
            '#type' => 'table',
            '#header' => $header,
            '#rows' => $data,
            // '#empty' => t('No users found'),
            ];
             //print_r($build);
             return [
              '#theme' => 'my_template',
              '#test_var' => $build,
              '#cache' => ['max-age'=>0,
              ],
              ];
  }
 
} 