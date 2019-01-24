<?php get_header(); ?>
  <?php
  //$hero = get_field('hero');
  if( have_rows('hero') ): the_row();
    $image = get_sub_field('background_image');
    $content = get_sub_field('content');
    $video_url = get_sub_field('video_url');
  ?>
  <div class="row center-xs middle-xs hero" style="background-image: url(<?= $image['url'] ?>);">
    <div class="content">
      <div class="row<?php if( $video_url ){ echo ' box'; } ?>">
          <div class="col-md-6<?php if( ! $video_url ){ echo ' box'; } ?>">
              <?= $content ?>
              <?php
              $link = get_sub_field('link');
              if( $link ){
                ?><a href="<?= $link['url'] ?>" class="btn" target="<?= $link['target'] ?>"><?= $link['title'] ?> &rarr;</a><?php
              }
              ?>
          </div>
          <?php
          if( $video_url ){
          ?>
          <div class="col-md-6">
            <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%;} .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='<?= $video_url ?>' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
          </div>
        <?php } ?>
      </div><!-- /.row -->
    </div><!-- /.content -->
  </div>
  <?php endif; // if( have_rows('hero') ): ?>
  <?php
  if( have_rows('intro') ): the_row();
    $intro = get_sub_field('text');
    if( $intro ):
      ?>
      <div class="row solid blue intro center-xs" style="padding-bottom: 0">
        <div class="content">
          <div class="col-xs">
            <?= $intro ?>
          </div>
        </div>
      </div>
      <?php
    endif;
    if( have_rows('buttons') ):
      echo '<div class="row center-xs solid blue"><div class="content row">';
      while( have_rows('buttons') ): the_row();
        if( have_rows('button') ): the_row();
          $icon = get_sub_field('icon');
          $link = get_sub_field('link');
          ?>
          <div class="col-xs">
            <a style="margin-bottom: 1rem; display: block;" href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><?= $icon ?></a>
            <h4><a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><?= $link['title'] ?></a></h4>
          </div>
          <?php
        endif;
      endwhile;
      echo '</div><!-- /.content --></div>';
    endif;
  endif; // if( have_rows('intro') ) ?>
  <?php
  $next_friday = strtotime( 'next friday' );
  $start_date = date('Y-m-d H:i:s',$next_friday);
  $args = [
    'start_date' => $start_date,
    'order' => 'ASC',
    'numberposts' => 3,
    'tax_query' => [
      [
        'taxonomy' => 'tribe_events_cat',
        'field' => 'slug',
        'terms' => 'friday-etec-meetings',
      ]
    ]
  ];
  $etec_friday_events = tribe_get_events( $args );
  //if( have_rows('events') ):
  if( 0 < count( $etec_friday_events ) ):
    ?>
    <div class="row center-xs events" style="padding: 60px 0 40px 0">
      <div class="content">
        <div class="col-md">
          <h2>ETEC Friday Meetings</h2>
<?php
    //echo '<pre>$next_friday = '.$next_friday.'<br/>next friday: '.$start_date.'<br />$etec_friday_events = '.print_r($etec_friday_events,true).'</pre><br/>';
?>
        </div>
      </div>
    </div>
    <div class="row center-xs events" style="padding-bottom: 40px;"><div class="content row">
    <?php

    $x = 0;
    foreach( $etec_friday_events as $friday_event ){
      if( $x > 2 )
        break;

      $thumbnail = ( has_post_thumbnail( $friday_event->ID ) )? get_the_post_thumbnail( $friday_event->ID, $size = 'full' ) : '<img src="' . get_stylesheet_directory_uri() . '/images/etec-fridays.800x600.jpg' . '" />';
      $link = get_permalink( $friday_event->ID );
      ?>
      <div class="col-sm event">
        <a href="<?= $link ?>"><?= $thumbnail ?></a>
        <h3 class="title" style="margin: 10px 0 0 0"><a href="<?= $link ?>"><?= get_the_title( $friday_event->ID ) ?></a></h3>
        <p style="margin-top: 0;"><?php echo tribe_events_event_schedule_details( $friday_event->ID, '', '' ); ?></p>
      </div>
      <?php
      $x++;
    }
    ?></div></div><?php
  endif; // if( have_rows('events') )
  ?>
  <div class="row solid bluetogreen" style="padding-bottom: 3rem;">
    <div class="content row">
      <div class="col-md-8" style="margin-bottom: 2rem;">
        <h4 style="margin-bottom: .5rem;">About ETEC</h4>
        <p style="text-align: left; margin-top: 0">Organized in 1973, the East Tennessee Economic Council (ETEC) is an independent, regional, non-profit membership organization dedicated to supporting the federal government’s missions in Oak Ridge as well as encouraging new opportunities to fully utilize the highly-skilled talent, cutting-edge technologies and unique facilities that make up the federal reservation, the University of Tennessee complex, and the TVA  region.</p>

        <p style="text-align: left;">ETEC works in strong partnership with federal contractors, DOE and NNSA representatives, state officials, small businesses, and other local economic development organizations to seek new ways to use federal investments in science and security to create prosperity, promote regional development, and explore opportunities for growth.</p>
        <p style="margin-top: 2.5rem;"><a href="/about/" class="btn blue">Learn More About ETEC &rarr;</a></p>
      </div>
      <!--<div class="col-md-4">

      </div>-->
      <div class="col-md-4">
        <h4 style="margin-bottom: .5rem;">Join ETEC</h4>
        <p style="margin-top: 0;"><em>Ready to join ETEC?</em> Find out how joining the East Tennessee Economic Council can benefit you and your business!</p>
        <p style="margin-bottom: 2rem;"><a href="/member-home/membership-information/" class="btn block blue">Join Now</a></p>
        <h4 style="margin-bottom: .5rem;">Renew Your Membership</h4>
        <p style="margin-top: 0">Looking to renew your annual East Tennessee Economic Council membership? Click the button below:</p>
        <p><a href="/members/membership-renewal/" class="btn block blue">Renew Now</a></p>
      </div>
    </div>
  </div><!-- /About ETEC -->
  <?php
  if( have_rows('highlights') ){
    ?>
    <div class="row solid gray highlights">
      <div class="content row">
        <?php
        while( have_rows('highlights') ): the_row();
          $highlight = get_sub_field('highlight');
          echo '<div class="col-md" style="margin-bottom: 2rem;">' . $highlight . '</div>';
        endwhile;
        ?>
      </div>
    </div>
    <?php
  }
  ?>
  <div class="row center-xs" style="padding-top: 40px; background-color: #fff">
    <div class="col-12">
      <h2>ETEC Premier Members</h2>
    </div>
  </div>
  <div class="row center-xs" style="background-color: #fff">
    <?php echo do_shortcode( '[gs_logo theme="slider1"]' ); ?>
    <div class="col-12"></div>
  </div>
  <div class="row solid blue center-xs">
    <div class="content" style="padding: 1rem 0;">
      <div class="col-xs">
        <h2 style="margin-bottom: 2.25rem;">Stay in the loop!</h2>
        <a href="/newsletter/" class="btn green">Subscribe to our Newsletter!</a>
      </div>
    </div>
  </div>
<?php get_footer(); ?>