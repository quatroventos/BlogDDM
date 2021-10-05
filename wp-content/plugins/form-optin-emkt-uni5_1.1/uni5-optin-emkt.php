<?php
/*
Plugin Name: Formulário de opt-in para o Email Marketing Uni5
Plugin URI: http://uni5.net
Description: Plugin de form opt-in do Email Marketing Uni5 - Uma lista de e-mail opt-in é formada por endereços de email de usuários que se inscrevem voluntariamente, através de um formulário, para receber atualizações e outros conteúdos. Se você já utiliza o serviço de Email Marketing Uni5 você pode ativar este plugin para obter um form opt-in para seu site WordPress.
Version: 1.1
Author: Uni5
Author URI: http://uni5.net
License: GPLv2
*/

/*
 *      Copyright 2017 Uni5
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 3 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/* ----------------- Adiciona o menu de configuração no painel do WordPress ----------------- */
 // Hook que adiciona o menu ao dashboard
 add_action('admin_menu', 'uni5_optin_form');
  
// Adicionando o menu
function uni5_optin_form() {
     add_menu_page(
        'Form optin Email Marketing Uni5',
        'Opt-in Uni5',
        'manage_options',
        'uni5_form_optin',
        'uni5_form_optin_callback',
        'dashicons-email-alt'
    );
}
 
// Informações da tela de administração do plugin
 function uni5_form_optin_callback() {

 	// Logo e botões de links
 	echo '<a class="button-secondary" href="https://uni5.com.br" title="Ir para o site da Uni5">Site da Uni5</strong></a> <a class="button-secondary" href="https://uni5.com.br/blog" title="Ir para blog da Uni5">Blog da Uni5</strong></a> <a class="button-secondary" href="https://uni5.com.br/wiki" title="Ir para a Central de Ajuda">Central de Ajuda</strong></a><br><br>';

 	// Texto informativo - instruções de uso
    echo '<h2><strong>FORMULÁRIO OPT-IN DO EMAIL MARKETING UNI5</strong></h2><br>
	     <font color="#808080">Instruções de uso:</font>
	     <br>Para começar a utilizar o formulário opt-in do Email Marketing você precisa primeiro gerar um novo código para poder inserí-lo em seu site.<br>
	     Verifique a se&ccedil;&atilde;o administrativa do Email Marketing, e gere um novo c&oacute;digo para formul&aacute;rio de opt-in.<br>
	     <br><font color="#34265F"><strong>Depois de ter copiado o código, acesse a p&aacute;gina de administra&ccedil;&atilde;o de Widgets para realizar a configuração do código de formulário opt-in.</strong></font>

     	<br>
      <a class="button-primary" href="' .admin_url( 'widgets.php' ). '" title="Ir para Widgets">Acessar área de <strong>Gerenciamento de Widgets</strong></a>';
 }


/* ----------------- Criação do widget ----------------- */
class uni5_optin_plugin extends WP_Widget {

    // Widget - Constructor
    function uni5_optin_plugin() {
        $widget_ops = array('classname' => 'my_widget_class', 'description' => __('Insira o código gerado na ferramenta de E-mail Marketing da Uni5 para criar um widget de formulário opt-in em seu site', 'plugin_emkt_form_optin'));
        $control_ops = array('width' => 400, 'height' => 300);
        parent::__construct(false, $name = __('Form Opt-in Email Marketing Uni5', 'plugin_emkt_form_optin'), $widget_ops, $control_ops );
    }

    // Widget - Criação do form
    function form($instance) {

      // Verifica os valores
          $title = esc_attr($instance['title']);
      if( $instance) {
           $textarea = esc_textarea($instance['textarea']);
      } else {
               $title = '';
           $textarea = '';
      }
      ?>

        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Título para o formulário:', 'plugin_emkt_form_optin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        <font color="#808080">Exemplo: Cadastre-se para receber nossas novidades</font>
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('<font color="#55438d"><strong>Cole aqui o código gerado na ferramenta Email Marketing:</strong></font>', 'plugin_emkt_form_optin'); ?></label>
        <textarea class="widefat" rows="10" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
        <font color="#808080">Precisa de ajuda na configuração? Então confere <a href="https://uni5.com.br/wiki/artigo/configurando-o-plugin-de-form-opt-email-marketing-uni5-em-seu-wordpress/">este artigo</a> :)</font>

    <?php }


    // Widget - Update dos valores
    function update($new_instance, $old_instance) {
             $instance = $old_instance;
     
      // Campos
      $instance['title'] = strip_tags($new_instance['title']);

      if ( current_user_can('unfiltered_html') )
        $instance['textarea'] =  $new_instance['textarea'];
      else
        $instance['textarea'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['textarea']) ) );
      return $instance;
    }


    // Widget - Display
    function widget($args, $instance) {
      extract( $args );
   
     // Opções da widget
     $title = apply_filters('widget_title', $instance['title']);
     $textarea = apply_filters( 'widget_textarea', empty( $instance['textarea'] ) ? '' : $instance['textarea'], $instance );
     echo $before_widget;
   
   // Widget - Exibição no site
   echo '<div class="widget-text wp_widget_plugin_box">';

    // Verifica se o título foi colocado
     if ( $title ) {
        echo $before_title . $title . $after_title;
     }

     // Verifica se o campo de textarea foi preenchido
     if( $textarea ) { echo wpautop($textarea); }
     echo '</div>';
     echo $after_widget;
  }
}

// Registro da widget
add_action('widgets_init', create_function('', 'return register_widget("uni5_optin_plugin");'));
