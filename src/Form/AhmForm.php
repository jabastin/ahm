<?php

namespace Drupal\ahm\Form;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Configure custom settings for this site.
 */
class AhmForm extends ConfigFormBase {
  /**
   * Constructor for ComproCustomForm.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    parent::__construct($config_factory);
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'ahm_admin_form';
  }
  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return ['config.ahm'];
  }
  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['ahm_jquery'] = array(
      '#type' => 'fieldset',
      '#title' => t('Ahm jQuery file included settings'),
      '#collapsible' => FALSE,
    );

     $form['ahm_jquery']['ahm_always_add_js'] = array(
    '#type' => 'checkbox',
    '#title' => t('Always include JavaScript file to the site.'),
    '#default_value' => $this->config('ahm.settings')->get('ahm_js'),
   ); 
    return parent::buildForm($form, $form_state);
  }

  /**
   * Youtube API credentials form validate.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $js = $form_state->getValue('ahm_always_add_js');
   
    if (isset($js)) {
      $this->configFactory()->getEditable('ahm.settings')->set('ahm_js', $js)->save();
      drupal_set_message(t('Ahm jQuery file added successfully..'));
    }
  }

}
