<?php

class ControllerExtensionModuleGoogleTranslate extends Controller {
    private $error = array();

    private $module_path = 'extension/module/google_translate';

    public function index()
    {
        $this->load->language($this->module_path);
        $this->document->setTitle($this->language->get('heading_name'));

        $this->load->model('setting/setting');

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $this->model_setting_setting->editSetting('module_google_translate_status', array('module_google_translate_status' => $this->request->post['status']));
            $this->model_setting_setting->editSetting('module_google_translate_key', array('module_google_translate_key' => $this->request->post['api_key']));

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
        }


        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_name'),
            'href' => $this->url->link($this->module_path, 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['status'] = $this->config->get('module_libre_translate_status');
        $data['api_key'] = $this->config->get('module_google_translate_key');


//        require_once(DIR_SYSTEM . 'library/libre_translate.php');

        //$libre_translate = new LibreTranslate();


        //echo $libre_translate->translate("Copper", "en", "uk");

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view($this->module_path, $data));
    }
}