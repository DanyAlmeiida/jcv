<?php 
/*
*
* Elementor "My Templates" Grid View with thumbnails
*
*/

add_action('elementor/editor/footer', function() {
  ?>
  <script type="text/javascript">
    jQuery('#tmpl-elementor-template-library-template-local').remove();
  </script>

  <style type="text/css" media="screen">
    #elementor-template-library-templates-container {
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .elementor-template-library-template.elementor-template-library-template-local {
      flex-direction: column;
      height: auto;
      max-width: calc(33.333% - 20px);
      margin-bottom: 20px;
    }

    .elementor-template-library-template.elementor-template-library-template-local > * {
      width: 100%;
      padding: 0
    }

  </style>

  <script type="text/template" id="tmpl-elementor-template-library-template-local">
    <# if( thumbnail ) { #>
      <img src="{{{ thumbnail }}}" alt="">
    <# } #>

      <div class="elementor-template-library-template-name elementor-template-library-local-column-1">{{{ title }}}</div>
      <div class="elementor-template-library-template-meta elementor-template-library-template-type elementor-template-library-local-column-2">{{{ elementor.translate( type ) }}}</div>
      <div class="elementor-template-library-template-meta elementor-template-library-template-author elementor-template-library-local-column-3">{{{ author }}}</div>
      <div class="elementor-template-library-template-meta elementor-template-library-template-date elementor-template-library-local-column-4">{{{ human_date }}}</div>

      <div class="elementor-template-library-template-controls elementor-template-library-local-column-5">
        <div class="elementor-template-library-template-preview">
          <i class="fa fa-eye" aria-hidden="true"></i>
          <span class="elementor-template-library-template-control-title"><?php echo __( 'Preview', 'elementor' ); ?></span>
        </div>
        <button class="elementor-template-library-template-action elementor-template-library-template-insert elementor-button elementor-button-success">
          <i class="eicon-file-download" aria-hidden="true"></i>
          <span class="elementor-button-title"><?php echo __( 'Insert', 'elementor' ); ?></span>
        </button>
        <div class="elementor-template-library-template-more-toggle">
          <i class="eicon-ellipsis-h" aria-hidden="true"></i>
          <span class="elementor-screen-only"><?php echo __( 'More actions', 'elementor' ); ?></span>
        </div>
        <div class="elementor-template-library-template-more">
          <div class="elementor-template-library-template-delete">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
            <span class="elementor-template-library-template-control-title"><?php echo __( 'Delete', 'elementor' ); ?></span>
          </div>
          <div class="elementor-template-library-template-export">
            <a href="{{ export_link }}">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
              <span class="elementor-template-library-template-control-title"><?php echo __( 'Export', 'elementor' ); ?></span>
            </a>
          </div>
        </div>
      </div>
  </script>
  <?php
}, 10, 99);