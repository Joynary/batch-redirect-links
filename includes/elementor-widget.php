<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class Guide_Elementor_Widget extends Widget_Base {
    public function get_name() {
        return 'guide_nav';
    }
    public function get_title() {
        return __('Guide Navigation', 'guide');
    }
    public function get_icon() {
        return 'eicon-site-settings';
    }
    public function get_categories() {
        return ['general'];
    }
    public function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('Navigation Items', 'guide'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control('csv_upload_info', [
            'label' => __('批量导入表格', 'guide'),
            'type' => Controls_Manager::RAW_HTML,
            'raw' => '<div style="padding:10px;background:#f9f9f9;border-radius:4px;margin:10px 0;">
                        <p><strong>支持CSV/Excel表格上传</strong></p>
                        <p>表格格式：URL | Name | Description</p>
                        <p>示例：</p>
                        <code>https://github.com,Github,代码托管平台<br>
                        https://stackoverflow.com,Stack Overflow,程序员问答社区</code>
                        <div id="guide-csv-upload-area" style="margin-top:10px;">
                            <input type="file" id="guide-csv-file" accept=".csv,.xlsx,.xls" style="margin-bottom:10px;">
                            <button type="button" id="guide-process-csv" class="elementor-button elementor-button-default">解析并添加到列表</button>
                        </div>
                      </div>',
        ]);
        $this->add_control('items', [
            'label' => __('Navigation Items', 'guide'),
            'type' => Controls_Manager::REPEATER,
            'fields' => [
                [
                    'name' => 'url',
                    'label' => __('URL', 'guide'),
                    'type' => Controls_Manager::TEXT,
                ],
                [
                    'name' => 'logo',
                    'label' => __('Logo', 'guide'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [ 'url' => '' ],
                ],
                [
                    'name' => 'name',
                    'label' => __('Name', 'guide'),
                    'type' => Controls_Manager::TEXT,
                ],

                [
                    'name' => 'desc',
                    'label' => __('Description', 'guide'),
                    'type' => Controls_Manager::TEXTAREA,
                ],
                [
                    'name' => 'corner_icon',
                    'label' => __('Corner Icon 1', 'guide'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [ 'url' => '' ],
                    'description' => __('Upload a circular icon that will appear on the top-right corner of the card', 'guide'),
                ],
                [
                    'name' => 'corner_icon_name',
                    'label' => __('Corner Icon Name 1', 'guide'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'description' => __('Name to display when hovering over the corner icon', 'guide'),
                    'condition' => [
                        'corner_icon[url]!' => '',
                    ],
                ],
                [
                    'name' => 'corner_icon_url',
                    'label' => __('Corner Icon URL 1', 'guide'),
                    'type' => Controls_Manager::URL,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'description' => __('URL to open when clicking the corner icon', 'guide'),
                    'condition' => [
                        'corner_icon[url]!' => '',
                    ],
                ],
                [
                    'name' => 'corner_icon_2',
                    'label' => __('Corner Icon 2', 'guide'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [ 'url' => '' ],
                    'description' => __('Upload a second circular icon that will appear on the top-right corner of the card', 'guide'),
                ],
                [
                    'name' => 'corner_icon_name_2',
                    'label' => __('Corner Icon Name 2', 'guide'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'description' => __('Name to display when hovering over the second corner icon', 'guide'),
                    'condition' => [
                        'corner_icon_2[url]!' => '',
                    ],
                ],
                [
                    'name' => 'corner_icon_url_2',
                    'label' => __('Corner Icon URL 2', 'guide'),
                    'type' => Controls_Manager::URL,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'description' => __('URL to open when clicking the second corner icon', 'guide'),
                    'condition' => [
                        'corner_icon_2[url]!' => '',
                    ],
                ],
                [
                    'name' => 'corner_icon_3',
                    'label' => __('Corner Icon 3', 'guide'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [ 'url' => '' ],
                    'description' => __('Upload a third circular icon that will appear on the top-right corner of the card', 'guide'),
                ],
                [
                    'name' => 'corner_icon_name_3',
                    'label' => __('Corner Icon Name 3', 'guide'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'description' => __('Name to display when hovering over the third corner icon', 'guide'),
                    'condition' => [
                        'corner_icon_3[url]!' => '',
                    ],
                ],
                [
                    'name' => 'corner_icon_url_3',
                    'label' => __('Corner Icon URL 3', 'guide'),
                    'type' => Controls_Manager::URL,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'description' => __('URL to open when clicking the third corner icon', 'guide'),
                    'condition' => [
                        'corner_icon_3[url]!' => '',
                    ],
                ],
                [
                    'name' => 'corner_icon_4',
                    'label' => __('Corner Icon 4', 'guide'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [ 'url' => '' ],
                    'description' => __('Upload a fourth circular icon that will appear on the top-right corner of the card', 'guide'),
                ],
                [
                    'name' => 'corner_icon_name_4',
                    'label' => __('Corner Icon Name 4', 'guide'),
                    'type' => Controls_Manager::TEXT,
                    'default' => '',
                    'description' => __('Name to display when hovering over the fourth corner icon', 'guide'),
                    'condition' => [
                        'corner_icon_4[url]!' => '',
                    ],
                ],
                [
                    'name' => 'corner_icon_url_4',
                    'label' => __('Corner Icon URL 4', 'guide'),
                    'type' => Controls_Manager::URL,
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'description' => __('URL to open when clicking the fourth corner icon', 'guide'),
                    'condition' => [
                        'corner_icon_4[url]!' => '',
                    ],
                ],
            ],
            'title_field' => '{{{ name }}}',
        ]);
        $this->end_controls_section();
    }
    public function render() {
        $settings = $this->get_settings_for_display();
        $items = $settings['items'] ?? [];
        echo '<div class="guide-nav-list">';
        foreach ($items as $item) {
            $logo = $item['logo']['url'] ?: "https://www.google.com/s2/favicons?sz=64&domain=" . parse_url($item['url'], PHP_URL_HOST);
            $name = esc_html($item['name']);
            $url = esc_url($item['url']);
            $corner_icon = $item['corner_icon']['url'] ?? '';
            $corner_icon_name = $item['corner_icon_name'] ?? '';
            $corner_icon_url = $item['corner_icon_url']['url'] ?? '';
            
            $corner_icon_2 = $item['corner_icon_2']['url'] ?? '';
            $corner_icon_name_2 = $item['corner_icon_name_2'] ?? '';
            $corner_icon_url_2 = $item['corner_icon_url_2']['url'] ?? '';
            
            $corner_icon_3 = $item['corner_icon_3']['url'] ?? '';
            $corner_icon_name_3 = $item['corner_icon_name_3'] ?? '';
            $corner_icon_url_3 = $item['corner_icon_url_3']['url'] ?? '';
            
            $corner_icon_4 = $item['corner_icon_4']['url'] ?? '';
            $corner_icon_name_4 = $item['corner_icon_name_4'] ?? '';
            $corner_icon_url_4 = $item['corner_icon_url_4']['url'] ?? '';
            
            echo '<div class="guide-nav-card">';
            
            // Corner icon 4 (if exists) - positioned to the leftmost
            if (!empty($corner_icon_4)) {
                echo '<div class="guide-nav-corner-icon guide-nav-corner-icon-4" data-corner-name="' . esc_attr($corner_icon_name_4) . '" data-corner-url="' . esc_attr($corner_icon_url_4) . '">';
                echo '<img src="' . esc_url($corner_icon_4) . '" alt="Corner Icon 4" />';
                echo '</div>';
            }
            
            // Corner icon 3 (if exists) - positioned to the leftmost
            if (!empty($corner_icon_3)) {
                echo '<div class="guide-nav-corner-icon guide-nav-corner-icon-3" data-corner-name="' . esc_attr($corner_icon_name_3) . '" data-corner-url="' . esc_attr($corner_icon_url_3) . '">';
                echo '<img src="' . esc_url($corner_icon_3) . '" alt="Corner Icon 3" />';
                echo '</div>';
            }
            
            // Corner icon 2 (if exists) - positioned to the left
            if (!empty($corner_icon_2)) {
                echo '<div class="guide-nav-corner-icon guide-nav-corner-icon-2" data-corner-name="' . esc_attr($corner_icon_name_2) . '" data-corner-url="' . esc_attr($corner_icon_url_2) . '">';
                echo '<img src="' . esc_url($corner_icon_2) . '" alt="Corner Icon 2" />';
                echo '</div>';
            }
            
            // Corner icon (if exists)
            if (!empty($corner_icon)) {
                echo '<div class="guide-nav-corner-icon" data-corner-name="' . esc_attr($corner_icon_name) . '" data-corner-url="' . esc_attr($corner_icon_url) . '">';
                echo '<img src="' . esc_url($corner_icon) . '" alt="Corner Icon" />';
                echo '</div>';
            }
            
            echo '<a href="' . $url . '" target="_blank" class="guide-nav-mainlink" style="flex:1;display:flex;text-decoration:none;color:inherit;">';
            echo '<div class="guide-nav-icon" title="' . esc_attr($item['desc']) . '"><img src="' . esc_url($logo) . '" alt="' . $name . '" /></div>';
            echo '<div class="guide-nav-content">';
            echo '<div class="guide-nav-title" data-desc="' . esc_attr($item['desc']) . '" title="' . esc_attr($item['desc']) . '">' . $name . '</div>';
            echo '<div class="guide-nav-desc" title="' . esc_attr($item['desc']) . '">' . esc_html($item['desc']) . '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    }
}