<?php
/**
 * Pattern
 *
 * @author Themeisle
 * @package church-fse
 * @since 1.0.0
 *
 * slug: archive-cover
 * title: Archive (Cover)
 * categories: ChurchFSE
 * keywords: archive, posts, cover
 */

use ChurchFSE\Assets_Manager;

return array(
	'title'      => __( 'Archive (Cover)', 'church-fse' ),
	'categories' => array( 'church-fse-layouts' ),
	'keywords'   => array( 'archive', 'posts', 'cover' ),
	'content'    => '
<!-- wp:group {"tagName":"main","align":"full","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}}}} -->
<main class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}}}} -->
<main class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"},"blockGap":"8px"},"elements":{"link":{"color":{"text":"var:preset|color|ti-fg-alt"}}}},"backgroundColor":"ti-bg-inv","textColor":"ti-fg-alt","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-ti-fg-alt-color has-ti-bg-inv-background-color has-text-color has-background has-link-color" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--40)"><!-- wp:query-title {"type":"archive","textAlign":"center","align":"wide"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"64px","bottom":"64px"},"blockGap":"40px","margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0px;margin-bottom:0px;padding-top:64px;padding-bottom:64px"><!-- wp:query {"queryId":1,"query":{"perPage":"4","pages":"","offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} -->
<!-- wp:cover {"useFeaturedImage":true,"dimRatio":80,"overlayColor":"ti-bg-inv","isUserOverlayColor":true,"contentPosition":"center center","tagName":"section"} -->
<section class="wp-block-cover"><span aria-hidden="true" class="wp-block-cover__background has-ti-bg-inv-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:post-title {"textAlign":"center","isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|ti-fg-alt"}}}}} /-->

<!-- wp:post-date {"textAlign":"center","fontSize":"small"} /--></div></section>
<!-- /wp:cover -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"align":"center","placeholder":"Add text or blocks that will display when a query returns no results.","backgroundColor":"ti-bg-alt"} -->
<p class="has-text-align-center has-ti-bg-alt-background-color has-background">No Posts were found</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results -->

<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<!-- wp:query-pagination-previous {"label":"Previous","style":{"typography":{"textTransform":"none"}}} /-->

<!-- wp:query-pagination-next {"label":"Next","style":{"typography":{"textTransform":"none"}}} /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></main>
<!-- /wp:group --></main>
<!-- /wp:group -->
	',
);
