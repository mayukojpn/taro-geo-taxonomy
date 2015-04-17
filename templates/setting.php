<?php
/**
 * Admin setting panel
 */

defined('ABSPATH') or die();

/** @var \Taro\GeoTaxonomy\Admin\Setting $this*/

?>

<div class="wrap wrap--tarogeo">
	<h2><?php $this->i18n->e('Taro Geo Taxonomy 設定ページ') ?></h2>

	<hr />

	<h3><span class="dashicons dashicons-admin-settings"></span> <?php $this->i18n->e('一般設定') ?></h3>
	<form action="<?php echo admin_url('options-general.php?page=taro-geo-taxonomy') ?>" method="post">
		<?php wp_nonce_field('taro-geo-taxonomy') ?>
		<table class="form-table">
			<tr>
				<th><label for="taxonomy-name"><?php $this->i18n->e('タクソノミー名') ?></label></th>
				<td>
					<input type="text" class="regular-text" id="taxonomy-name" name="taxonomy-name" value="<?php echo esc_attr($this->taxonomy) ?>" />
					<p class="description">
						<?php $this->i18n->e('タクソノミー名は半角英数(小文字）と-または_だけです。また、途中で変更するとこれまでのデータは失われます。') ?>
					</p>
				</td>
			</tr>
			<tr>
				<th><label for="taxonomy-label"><?php $this->i18n->e('ラベル') ?></label></th>
				<td>
					<input type="text" class="regular-text" id="taxonomy-label" name="taxonomy-label" value="<?php echo esc_attr($this->label) ?>" />
					<p class="description">
						<?php $this->i18n->e('アーカイブページのタイトルなどに使われます。') ?>
					</p>
				</td>
			</tr>
			<tr>
				<th><label><?php $this->i18n->e('サポートする投稿タイプ') ?></label></th>
				<td>
					<?php foreach( $this->get_post_types() as $post_type): ?>
						<label class="inline">
							<input type="checkbox" name="post_types[]" value="<?php echo esc_attr($post_type->name) ?>" <?php checked($this->is_supported($post_type->name)) ?> />
							<?php echo esc_html($post_type->label) ?>
						</label>
					<?php endforeach; ?>
				</td>
			</tr>
		</table>
		<?php submit_button($this->i18n->s('更新')) ?>
	</form>

	<hr />

	<h3><span class="dashicons dashicons-download"></span> <?php $this->i18n->e('インポート') ?></h3>

	<div class="geo-importer">

		<form id="taro-geo-import-form" action="<?php echo admin_url('admin-ajax.php') ?>" method="post">
			<input type="hidden" name="action" value="taro-geo-import" />
			<?php wp_nonce_field('taro-geo-import', '_wpnonce', false) ?>
			<p class="description">
				<?php echo $this->option['source']['description']; ?>
			</p>
			<?php submit_button($this->i18n->s('インポート')) ?>
		</form>
	</div>

</div><!--- //.wrap -->
