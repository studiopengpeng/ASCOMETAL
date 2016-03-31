<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Plugin Name: PE Recent Posts
 * Plugin URI: http://pixelemu.com
 * Description: Simple Slider for Posts
 * Version: 1.0.3
 * Author: pixelemu.com
 * Author URI: http://www.pixelemu.com
 * Text Domain: pe-recent-posts
 * License: GPLv2 or later
 */
 
/**
 * Popular posts tracking
 *
 * Tracks the number of views for a post in a custom field
 */

// Set/check session
if ( !session_id() ){
	session_start();
}
// count hits of posts
function pe_base_track_popular_posts() {
	// Only run the process for single posts, pages and post types
	if ( is_singular()) {
		global $post;
		$custom_field = '_pe_base_popular_posts_count';
		// Only track a one view per post for a single visitor session to avoid duplications
		if ( !isset( $_SESSION["pe-popular-posts-count-{$post->ID}"] ) ) {
			// Update view count 
			$view_count = get_post_meta( $post->ID, $custom_field, true );
			$stored_count = ( isset($view_count) && !empty($view_count) ) ? ( intval($view_count) + 1 ) : 1;
			$update_meta = update_post_meta( $post->ID, $custom_field, $stored_count );
			// Check for errors
			if ( is_wp_error($update_meta) )
				error_log( $update_meta->get_error_message(), 0 );
			// Store session in "viewed" state
			$_SESSION["pe-popular-posts-count-{$post->ID}"] = 1;
		}
		// uncomment these 3 lines to show views of post (right after <body> tag)
		/*echo '<p style="color:red; text-align:center; margin:1em 0;">';
		echo get_post_meta( $post->ID, $custom_field, true );
		echo ' views of this post</p>';*/
	}
}
add_action('wp_head', 'pe_base_track_popular_posts');

// excerpt limit - BEGIN
if ( ! function_exists( 'get_excerpt_plugin' ) ) {
	function get_excerpt_plugin($count){
	  $excerpt = get_the_excerpt();
	  $excerpt = strip_tags($excerpt);
	  $excerpt = substr($excerpt, 0, $count);
	  $excerpt = '<div class="excerpt-text">'.$excerpt.'...</div>';
	  return $excerpt;
	}
}
// excerpt limit - END
	
if(!class_exists('PE_Recent_Posts_Plugin')){
    class PE_Recent_Posts_Plugin extends WP_Widget {

		public function __construct() {
			$widget_ops = array( 
				'classname' => 'PE_Recent_Posts',
				'description' => __('Show recent posts.', 'pe-recent-posts'),
			);
			parent::__construct( 'PE_Recent_Posts', 'PE Recent Posts', $widget_ops );
		}

        public function widget($args,  $setup)
        {
            extract($args);
            
            $post_type = 'post';
            if(isset($setup['post_type'])){
            	$post_type = $setup['post_type'];
            }
            
			$post_type_category = 'category';
			if(isset($setup['post_type_category'])){
				$post_type_category = $setup['post_type_category'];
			}
			
			$count_posts = wp_count_posts($post_type);
			
			$readmore = 0;
			if(isset($setup['readmore'])){
				$readmore = $setup['readmore'];
			}
			
			$create_date = 0;
			if(isset($setup['create_date'])){
				$create_date = $setup['create_date'];
			}
			
			$sticky_posts = 0;
			if(isset($setup['sticky_posts'])){
				$sticky_posts = $setup['sticky_posts'];
			}
			
			$number_of_all_items = 9;
			if(isset($setup['number_of_all_items'])){
				$number_of_all_items = $setup['number_of_all_items'];
			}

			if(!isset($setup['number_of_columns'])){
				$number_of_columns = 1;
			} else {
				$number_of_columns = $setup['number_of_columns'];
			}

			if(!isset($setup['number_of_rows'])){
				$number_of_rows = 1;
			} else {
				$number_of_rows = $setup['number_of_rows'];
			}

			$grid_spacing = 10;
			if(isset($setup['grid_spacing'])){
				$grid_spacing = $setup['grid_spacing'];
			}
			
			$slide_width = 100 / $number_of_columns;
			$unique_id = $this->id;
			if ( post_type_exists( $post_type ) ) {
				if ($number_of_all_items > $count_posts->publish){
					$number_of_all_items = $count_posts->publish;
				}
			}

			$order_posts = 'Date';
			if(isset($setup['order_posts'])){
				$order_posts = $setup['order_posts'];
			}
			
			$meta_key = '';
			if($order_posts == 'meta_value_num'){
				$meta_key = '_pe_base_popular_posts_count';
			}
			
			$order_direction = 'DESC';
			if(isset($setup['order_direction'])){
				$order_direction = $setup['order_direction'];
			}
			
			$navigation_way = 1;
			if(isset($setup['navigation_way'])){
				$navigation_way = $setup['navigation_way'];
			}
			
            $title_widget = apply_filters('widget_title', $setup['title']);
			
			
            if ( empty($title_widget) ){
            	$title_widget = false;
				$before_title = false;
				$after_title = false;
            }
            echo $before_widget;
            echo $before_title;
            echo $title_widget;
            echo $after_title;
			
			$desc_limit = 55;
			if(isset($setup['desc_limit'])){
				$desc_limit = $setup['desc_limit'];
			}
			
			$show_thumbnail = 1;
			if(isset($setup['show_thumbnail'])){
				$show_thumbnail = $setup['show_thumbnail'];
			}
			
			$image_alignment = 'left';
			if(isset($setup['image_alignment'])){
				$image_alignment = $setup['image_alignment'];
			}
			
			$image_size = 'thumbnail';
			if(isset($setup['image_size'])){
				$image_size = $setup['image_size'];
			}
			
			$category_id = '';
			if(isset($setup['category_id'])){
				$category_id = $setup['category_id'];
			}
			
			$even_odd = '';
			if ($number_of_columns % 2){
				$even_odd = 'odd-items-in-row';
			} else{
				$even_odd = 'even-items-in-row';
			}
			
			// get category for CPT
			$category_id_loop = '';
			$category_id_taxonomy = '';
			$tag_loop = '';
			$tax_query = '';
			$current_taxonomy ='';
			$field_value = '';
			// get taxonomies that belongs to $post_type
   			$taxonomy_objects = get_object_taxonomies( $post_type, 'names' );
			if($post_type == 'post' && !empty($category_id)){
				$taxonomy_to_check = get_term($category_id, $post_type_category);
				if(!empty($taxonomy_to_check)){
					$current_taxonomy = $taxonomy_to_check->taxonomy;
				}
			}
			
			// check for post type and post type taxonomy
			if(($post_type == 'post') && ($post_type_category == 'category')){
				if($current_taxonomy == $post_type_category){
					$category_id_loop = $category_id;
				} else {
					$category_id_loop = '';
				}
				$tag_loop = '';
				$tax_query = '';
			} else if(($post_type == 'post') && ($post_type_category == 'post_tag')){
				if($current_taxonomy == $post_type_category){
					$tag_loop = $category_id;
				} else {
					$tag_loop = '';
				}
				$category_id_loop = '';
				$tax_query = '';
			} else if(($post_type == 'post') && ($post_type_category == 'post_format ')){
				if($current_taxonomy == $post_type_category){
					$category_id_loop = $category_id;
				} else {
					$category_id_loop = '';
				}
				$tag_loop = '';
				$tax_query = '';
			} else if(($post_type != 'post')){
				if(!empty($category_id) && in_array($post_type_category, $taxonomy_objects)){
					$tax_query =
						array(
							array(
								'taxonomy' => ''.$post_type_category.'',
								'field'    => 'term_id',
								'terms'    => $category_id,
							),
						);
				} else {
					$tax_query = '';
				}
				$category_id_loop = '';
				$tag_loop = '';
			}
			
			
			// loop
			$loop = new WP_Query(array(
				'post_type' => ''.$post_type.'', 
				'posts_per_page' => ''.$number_of_all_items.'', 
				'ignore_sticky_posts' => ''.$sticky_posts.'', 
				'meta_key' => ''.$meta_key.'', 
				'orderby'=> ''.$order_posts.'', 
				'order' => ''.$order_direction.'',
				'cat' => $category_id_loop,
				'tax_query' => $tax_query,
				'tag_id' => $tag_loop
			));
			$counter = 0;
			$counter_bullets = 0;
			while ( $loop->have_posts() ) : $loop->the_post();
				$counter_bullets++;
			endwhile;
			$bullets_on_board = '';
			if (($navigation_way == 1) && ($counter_bullets > ($number_of_columns * $number_of_rows))){
				$bullets_on_board = 'bullets-on-board';
			} 
			wp_reset_query();
			
			// check if CPT and category taxonomy exists, if they have relation
			if(post_type_exists( $post_type ) && taxonomy_exists( $post_type_category) && !in_array($post_type_category, $taxonomy_objects) && !empty($post_type_category)){
				echo __('Entered <strong>Post Type Taxonomy</strong> does not belong to <strong>Post Type</strong>.', 'pe-recent-posts');
			} else if ( !post_type_exists( $post_type ) && (!taxonomy_exists( $post_type_category) && !empty($post_type_category))) {
			   echo __('Entered <strong>Post Type</strong> and <strong>Post Type Taxonomy</strong> does not exist.', 'pe-recent-posts');
			} else if(!post_type_exists( $post_type )){
				echo __('Entered <strong>Post Type</strong> does not exist.', 'pe-recent-posts');
			} else if(!taxonomy_exists( $post_type_category) && !empty($post_type_category)){
				echo __('Entered <strong>Post Type Taxonomy</strong> does not exist.', 'pe-recent-posts');
			} else { ?>
			<div id="myCarousel<?php echo $unique_id; ?>" class="pe-recent-posts-outer carousel slide <?php echo $bullets_on_board; ?> columns-<?php echo $number_of_columns.' '.$even_odd; ?>">
				<div class="carousel-inner image-<?php echo $image_alignment; ?>" style="margin-bottom: -<?php echo $grid_spacing; ?>px;">
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
								<?php 
								$counter++;
								global $post;
								$permalink = get_permalink($post->ID);
								if ($number_of_columns * $number_of_rows == 1){ 
									if ($counter == 1){ ?>
										<div class="item active" style="margin-left: -<?php echo $grid_spacing; ?>px;">
									<?php } else { ?>
										<div class="item" style="margin-left: -<?php echo $grid_spacing; ?>px;">
									<?php }?>
									
								<?php } else{
									if (($counter % ($number_of_columns * $number_of_rows) == 1)){
											if ($counter == 1){ ?>
												<div class="item active" style="margin-left: -<?php echo $grid_spacing; ?>px;">
											<?php } else { ?>
												<div class="item" style="margin-left: -<?php echo $grid_spacing; ?>px;">
											<?php } ?>
									<?php }
								} ?>
								<ul class="thumbnails" style="width: <?php echo $slide_width; ?>%;">
									<li>
										<div class="thumbnail-box clearfix" style="padding-left: <?php echo $grid_spacing; ?>px; padding-bottom: <?php echo $grid_spacing; ?>px;">
											<?php if ($image_alignment=='bottom') { ?>
											<div class="caption fadeInUp animated <?php if ( has_post_thumbnail()){ echo 'image-on'; } ?>">
												<?php if($create_date == 1){ ?>
													<span class="pe-creation-date"><?php echo get_the_date(); ?></span>
												<?php } ?>
												<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
												<?php if($create_date == 2){ ?>
													<span class="pe-creation-date"><?php echo get_the_date(); ?></span>
												<?php } ?>
												<?php echo get_excerpt_plugin($desc_limit); ?>
												<?php if($readmore == 1){
													echo '<a class="readmore" href="'.$permalink.'">'.__('Read more', 'pe-recent-posts').'</a>'; 
												} ?>
											</div> 
											<?php } ?>
											<?php if ( has_post_thumbnail() && $show_thumbnail == '1'){
													echo the_post_thumbnail($image_size);
											} ?>
											<?php if ($image_alignment!='bottom') { ?>
											<div class="caption fadeInUp animated <?php if ( has_post_thumbnail()){ echo 'image-on'; } ?>">
												<?php if($create_date == 1){ ?>
													<span class="pe-creation-date"><?php echo get_the_date(); ?></span>
												<?php } ?>
												<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
												<?php if($create_date == 2){ ?>
													<span class="pe-creation-date"><?php echo get_the_date(); ?></span>
												<?php } ?>
												<?php echo get_excerpt_plugin($desc_limit); ?>
												<?php if($readmore == 1){
													echo '<a class="readmore" href="'.$permalink.'">'.__('Read more', 'pe-recent-posts').'</a>'; 
												} ?>
											</div> 
											<?php } ?>
										</div>
									</li>
								</ul>
								<?php if (($counter % ($number_of_columns * $number_of_rows)) == 0){ ?>
									</div>
								<?php } ?> 	
						<?php endwhile; ?>
						<?php if ((($counter % ($number_of_columns * $number_of_rows)) != 0) && ($counter >= ($number_of_columns * $number_of_rows))){ ?>
							</div>
						<?php } ?> 
						<?php wp_reset_query(); ?>
			</div>
			<?php 
			if($counter < ($number_of_columns * $number_of_rows)){ ?>
			</div>	
			<?php } ?>
			<?php if (($navigation_way == 1) && ($counter > ($number_of_columns * $number_of_rows))){ ?>
	        	<?php $counter2 = 0; ?>
		        <ol class="carousel-indicators">
		        	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		        		<?php $counter2++; ?>
		        	<?php if (($counter2 % ($number_of_columns * $number_of_rows) == 1) || ($number_of_columns * $number_of_rows) == 1){
		        		if ($counter2 == 1){ ?>
	        			<li data-target="#myCarousel<?php echo $unique_id; ?>" data-slide-to="0" class="active"></li>
					<?php } else { ?>
						<li data-target="#myCarousel<?php echo $unique_id; ?>" data-slide-to="<?php echo ($counter2 -1)/($number_of_columns * $number_of_rows); ?>"></li>
					<?php } ?>	
				<?php } ?>
	            <?php endwhile; ?>
	            <?php wp_reset_query(); ?>
	        	</ol>  
        	<?php } ?>
		</div>
		<?php } ?>
		<?php
            echo $after_widget;
        }

        //Admin Form

        public function form($setup)
        {
            $setup = wp_parse_args( (array) $setup, array('title' => __('MISC Posts', 'pe-recent-posts'),
            	'readmore' => '0',
            	'create_date' => '0',
            	'post_type' => 'post',
            	'post_type_category' => 'category',
            	'sticky_posts' => '0',
                'number_of_all_items' => '9',
                'number_of_columns' => '1',
                'number_of_rows' => '3',
                'order_posts' => 'Date',
                'order_direction' => 'DESC',
                'navigation_way' => '1',
                'title' => __('PE Recent Posts', 'pe-recent-posts'),
                'desc_limit' => '55',
                'image_alignment' => 'left',
                'show_thumbnail' => '1',
                'image_size' => 'thumbnail',
                'grid_spacing' => '10',
                'category_id' => '' ) );
				
			$title_widget= esc_attr($setup['title']);
			$post_type = $setup['post_type'];
			$post_type_category = $setup['post_type_category'];
			$sticky_posts = $setup['sticky_posts'];
			$readmore = $setup['readmore'];
			$create_date = $setup['create_date'];
			$number_of_all_items = $setup['number_of_all_items'];
            $order_posts = $setup['order_posts'];
			$desc_limit = $setup['desc_limit'];
			$show_thumbnail = $setup['show_thumbnail'];
			$image_alignment = $setup['image_alignment'];
			$image_size = $setup['image_size'];
			$category_id = $setup['category_id'];
			$number_of_rows = $setup['number_of_rows'];
			$number_of_columns = $setup['number_of_columns'];
			$grid_spacing = $setup['grid_spacing'];
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'pe-recent-posts'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title_widget; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type', 'pe-recent-posts'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" type="text" value="<?php echo $post_type; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('post_type_category'); ?>"><?php _e('Post Type Taxonomy', 'pe-recent-posts'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('post_type_category'); ?>" name="<?php echo $this->get_field_name('post_type_category'); ?>" type="text" value="<?php echo $post_type_category; ?>" />
            </p>
            <p>
            	<label for="<?php echo $this->get_field_id('category_id'); ?>"><?php _e('Taxonomy (empty taxonomy items are not displayed)', 'pe-recent-posts'); ?></label>
				<select name="<?php echo $this->get_field_name('category_id'); ?>" id="<?php echo $this->get_field_id('category_id'); ?>">
				<?php if (taxonomy_exists(($post_type_category))){ ?>
					<option value=""><?php _e('All Taxonomy Items', 'pe-recent-posts'); ?></option>
					 <?php 
					    $values = array(
					      'orderby' => 'name',
					      'order' => 'ASC',
					      'taxonomy' => ''.$post_type_category.''
					     );
					  $categories = get_categories($values); 
					  foreach ($categories as $category) { ?>
					    <option value="<?php echo $category->cat_ID; ?>"<?php selected( $setup['category_id'], $category->cat_ID ); ?>><?php echo $category->cat_name; ?></option>	
				  	  <?php } ?>
				<?php } else if(empty($post_type_category)) { ?>
					<option value=""><?php _e('Post Type Taxonomy is empty.', 'pe-recent-posts'); ?></option>
				<?php } else { ?>
					<option value=""><?php _e('Entered Post Type Taxonomy is wrong.', 'pe-recent-posts'); ?></option>
				<?php } ?>				  
				</select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('sticky_posts'); ?>"><?php _e('Force display sticky posts (only for posts)', 'pe-recent-posts'); ?></label>
                <select class="pe-easy-slider-source-select" name="<?php echo $this->get_field_name('sticky_posts'); ?>" id="<?php echo $this->get_field_id('sticky_posts'); ?>">
                    <option value="0"<?php selected( $setup['sticky_posts'], '0' ); ?>><?php _e('Yes', 'pe-recent-posts'); ?></option>
                    <option value="1"<?php selected( $setup['sticky_posts'], '1' ); ?>><?php _e('No', 'pe-recent-posts'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('number_of_columns'); ?>"><?php _e('Number of items in row', 'pe-recent-posts'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('number_of_columns'); ?>" name="<?php echo $this->get_field_name('number_of_columns'); ?>" type="text" value="<?php echo $number_of_columns; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('number_of_rows'); ?>"><?php _e('Number of rows', 'pe-recent-posts'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('number_of_rows'); ?>" name="<?php echo $this->get_field_name('number_of_rows'); ?>" type="text" value="<?php echo $number_of_rows; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('number_of_all_items'); ?>"><?php _e('Number of all items', 'pe-recent-posts'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('number_of_all_items'); ?>" name="<?php echo $this->get_field_name('number_of_all_items'); ?>" type="text" value="<?php echo $number_of_all_items; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('create_date'); ?>"><?php _e('Creation Date', 'pe-recent-posts'); ?></label>
                <select class="pe-recent-posts-source-select" name="<?php echo $this->get_field_name('create_date'); ?>" id="<?php echo $this->get_field_id('create_date'); ?>">
                    <option value="0"<?php selected( $setup['create_date'], '0' ); ?>><?php _e('Hide', 'pe-recent-posts'); ?></option>
                    <option value="1"<?php selected( $setup['create_date'], '1' ); ?>><?php _e('Show above title', 'pe-recent-posts'); ?></option>
                    <option value="2"<?php selected( $setup['create_date'], '2' ); ?>><?php _e('Show below title', 'pe-recent-posts'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('readmore'); ?>"><?php _e('Readmore', 'pe-recent-posts'); ?></label>
                <select class="pe-recent-posts-source-select" name="<?php echo $this->get_field_name('readmore'); ?>" id="<?php echo $this->get_field_id('readmore'); ?>">
                    <option value="0"<?php selected( $setup['readmore'], '0' ); ?>><?php _e('Hide', 'pe-recent-posts'); ?></option>
                    <option value="1"<?php selected( $setup['readmore'], '1' ); ?>><?php _e('Show', 'pe-recent-posts'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('order_direction'); ?>"><?php _e('Order Direction', 'pe-recent-posts'); ?></label>
                <select name="<?php echo $this->get_field_name('order_direction'); ?>" id="<?php echo $this->get_field_id('order_direction'); ?>">
                    <option value="ASC"<?php selected( $setup['order_direction'], 'ASC' ); ?>><?php _e('ASC', 'pe-recent-posts'); ?></option>
                    <option value="DESC"<?php selected( $setup['order_direction'], 'DESC' ); ?>><?php _e('DESC', 'pe-recent-posts'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('order_posts'); ?>"><?php _e('Ordering', 'pe-recent-posts'); ?></label>
                <select name="<?php echo $this->get_field_name('order_posts'); ?>" id="<?php echo $this->get_field_id('order_posts'); ?>">
                    <option value="date"<?php selected( $setup['order_posts'], 'date' ); ?>><?php _e('Date', 'pe-recent-posts'); ?></option>
                    <option value="title"<?php selected( $setup['order_posts'], 'title' ); ?>><?php _e('Title', 'pe-recent-posts'); ?></option>
                    <option value="comment_count"<?php selected( $setup['order_posts'], 'comment_count' ); ?>><?php _e('Most commented', 'pe-recent-posts'); ?></option>
                    <option value="meta_value_num"<?php selected( $setup['order_posts'], 'meta_value_num' ); ?>><?php _e('Most read', 'pe-recent-posts'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('navigation_way'); ?>"><?php _e('Navigation', 'pe-recent-posts'); ?></label>
                <select name="<?php echo $this->get_field_name('navigation_way'); ?>" id="<?php echo $this->get_field_id('navigation_way'); ?>">
                	<option value="0"<?php selected( $setup['navigation_way'], '0' ); ?>><?php _e('None', 'pe-recent-posts'); ?></option>
                    <option value="1"<?php selected( $setup['navigation_way'], '1' ); ?>><?php _e('Bullets', 'pe-recent-posts'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('desc_limit'); ?>"><?php _e('Description Limit (chars)', 'pe-recent-posts'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('desc_limit'); ?>" name="<?php echo $this->get_field_name('desc_limit'); ?>" type="text" value="<?php echo $desc_limit; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('image_alignment'); ?>"><?php _e('Image Alignment', 'pe-recent-posts'); ?></label>
                <select name="<?php echo $this->get_field_name('image_alignment'); ?>" id="<?php echo $this->get_field_id('image_alignment'); ?>">
                    <option value="left"<?php selected( $setup['image_alignment'], 'left' ); ?>><?php _e('left', 'pe-recent-posts'); ?></option>
                    <option value="right"<?php selected( $setup['image_alignment'], 'right' ); ?>><?php _e('right', 'pe-recent-posts'); ?></option>
                    <option value="top"<?php selected( $setup['image_alignment'], 'top' ); ?>><?php _e('top', 'pe-recent-posts'); ?></option>
                    <option value="bottom"<?php selected( $setup['image_alignment'], 'bottom' ); ?>><?php _e('bottom', 'pe-recent-posts'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e('Show Thumbnail', 'pe-recent-posts'); ?></label>
                <select name="<?php echo $this->get_field_name('show_thumbnail'); ?>" id="<?php echo $this->get_field_id('show_thumbnail'); ?>">
                    <option value="0"<?php selected( $setup['show_thumbnail'], '0' ); ?>><?php _e('No', 'pe-recent-posts'); ?></option>
                    <option value="1"<?php selected( $setup['show_thumbnail'], '1' ); ?>><?php _e('Yes', 'pe-recent-posts'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('image_size'); ?>"><?php _e('Image Size', 'pe-recent-posts'); ?></label>
                <select name="<?php echo $this->get_field_name('image_size'); ?>" id="<?php echo $this->get_field_id('image_size'); ?>">
                    <option value="thumbnail"<?php selected( $setup['image_size'], 'thumbnail' ); ?>><?php _e('thumbnail', 'pe-recent-posts'); ?></option>
                    <option value="medium"<?php selected( $setup['image_size'], 'medium' ); ?>><?php _e('medium', 'pe-recent-posts'); ?></option>
                    <option value="large"<?php selected( $setup['image_size'], 'large' ); ?>><?php _e('large', 'pe-recent-posts'); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('grid_spacing'); ?>"><?php _e('Grid Spacing (px)', 'pe-recent-posts'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('grid_spacing'); ?>" name="<?php echo $this->get_field_name('grid_spacing'); ?>" type="text" value="<?php echo $grid_spacing; ?>" />
            </p>
        <?php
        }

        //Update widget

        public function update($new_setup, $old_setup)
        {
            $setup=$old_setup;
            $setup['title'] = strip_tags($new_setup['title']);
			$setup['post_type'] = $new_setup['post_type'];
			$setup['post_type_category'] = $new_setup['post_type_category'];
			$setup['sticky_posts'] = $new_setup['sticky_posts'];
			$setup['readmore'] = $new_setup['readmore'];
			$setup['create_date'] = $new_setup['create_date'];
			$setup['number_of_all_items']  = $new_setup['number_of_all_items'];
			$setup['number_of_columns']  = $new_setup['number_of_columns'];
			$setup['number_of_rows']  = $new_setup['number_of_rows'];
			$setup['order_posts']  = $new_setup['order_posts'];
			$setup['order_direction']  = $new_setup['order_direction'];
			$setup['navigation_way']  = $new_setup['navigation_way'];
			$setup['desc_limit']  = strip_tags($new_setup['desc_limit']);
			$setup['image_alignment']  = $new_setup['image_alignment'];
			$setup['show_thumbnail']  = $new_setup['show_thumbnail'];
			$setup['image_size']  = $new_setup['image_size'];
			$setup['category_id']  = $new_setup['category_id'];
			$setup['grid_spacing']  = strip_tags($new_setup['grid_spacing']);
            return $setup;
        }
    }
}

//add CSS
function pe_recent_posts_css() {
	if (!(wp_style_is( 'animate.css', 'enqueued' ))) {
		wp_enqueue_style( 'animate', plugins_url().'/pe-easy-slider/css/animate.css' );
	}
	wp_enqueue_style( 'pe-recent-posts', plugins_url().'/pe-recent-posts/css/pe-recent-posts.css' ); 
}
add_action( 'wp_enqueue_scripts', 'pe_recent_posts_css' );

//add JS
function pe_recent_posts_js()
{
	wp_enqueue_script('jquery');
	if (!(wp_script_is( 'bootstrap.js', 'enqueued' ) || wp_script_is( 'bootstrap.min.js', 'enqueued' ))) {
		wp_register_script( 'bootstrap.min', plugins_url() . '/pe-recent-posts/js/bootstrap.min.js', array('jquery'), '3.2.0', false );
		wp_enqueue_script('bootstrap.min');
	}
	wp_register_script( 'pe-recent-posts', plugins_url() . '/pe-recent-posts/js/pe-recent-posts.js', array('jquery'), '1.0.0', false );
	wp_enqueue_script('pe-recent-posts');
}
add_action( 'wp_enqueue_scripts', 'pe_recent_posts_js' );

//load widget
add_action('widgets_init',
     create_function('', 'return register_widget("PE_Recent_Posts_Plugin");')
);
?>