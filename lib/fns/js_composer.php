<?php

namespace AvadaChild\fns\jscomposer;

function remove_frontend_links() {
  vc_disable_frontend(); // this will disable frontend editor
}
add_action( 'vc_after_init', __NAMESPACE__ . '\\remove_frontend_links' );