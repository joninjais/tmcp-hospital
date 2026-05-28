<form role="search" method="get" class="tmcp-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text" for="tmcp-search-field"><?php esc_html_e( 'ค้นหา:', 'tmcp-hospital' ); ?></label>
    <input type="search" id="tmcp-search-field" class="tmcp-search-input" name="s"
           placeholder="<?php esc_attr_e( 'ค้นหา…', 'tmcp-hospital' ); ?>"
           value="<?php echo esc_attr( get_search_query() ); ?>">
    <button type="submit" class="tmcp-search-submit" aria-label="<?php esc_attr_e( 'ค้นหา', 'tmcp-hospital' ); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
            <path d="M20 20l-3-3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>
</form>
