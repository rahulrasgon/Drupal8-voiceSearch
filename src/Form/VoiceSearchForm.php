<?php  

/**  
 * @file  
 * Contains Drupal\voice_search\Form\VoiceSearchForm.  
 */  

namespace Drupal\voice_search\Form;  

use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;  

class VoiceSearchForm extends ConfigFormBase {  
  /**  
   * {@inheritdoc}  
   */  
  protected function getEditableConfigNames() {  
    return [  
      'voice.adminsettings',  
    ];  
  }  

  /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'voice_search';  
  } 

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('voice.adminsettings');

    $form['basic'] = [
      '#type' => 'details',
      '#title' => $this->t('Voice Search Configuration'),
      '#open' => TRUE,
    ];

    $form['basic']['voice_search_status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable'),
      '#default_value' => $config->get('voice_search_status'),
    ];
    return parent::buildForm($form, $form_state);
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('voice.adminsettings')
      ->set('voice_search_status', $values['voice_search_status'])
      ->save();
  }
}  
