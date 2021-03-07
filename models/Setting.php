<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property int $setting_id
 * @property int|null $no_navbar_border
 * @property int|null $body_small_text
 * @property int|null $navbar_small_text
 * @property int|null $sidebar_nav_small_text
 * @property int|null $footer_small_text
 * @property int|null $sidebar_nav_flat_style
 * @property int|null $sidebar_nav_legacy_style
 * @property int|null $sidebar_nav_compact
 * @property int|null $sidebar_nav_child_indent
 * @property int|null $main_sidebar_disable_hover
 * @property int|null $brand_small_text
 * @property string|null $navbar_variant
 * @property string|null $accent_color_variant
 * @property string|null $sidebar_variant
 * @property string|null $brand_logo_variant
 *
 * @property Employee[] $employees
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_navbar_border', 'navbar_position_fix', 'footer_position_fix', 'body_small_text', 'navbar_small_text', 'sidebar_nav_small_text', 'footer_small_text', 'mini_sidebar', 'sidebar_nav_flat_style', 'sidebar_nav_legacy_style', 'sidebar_nav_compact', 'sidebar_nav_child_indent', 'sidebar_nav_faf', 'sidebar_nav_fas', 'main_sidebar_disable_hover', 'brand_small_text'], 'integer'],
            [['navbar_variant', 'accent_color_variant', 'sidebar_variant', 'brand_logo_variant'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'setting_id' => 'Setting ID',
            'no_navbar_border' => 'No Navbar Border',
            'body_small_text' => 'Body Small Text',
            'navbar_small_text' => 'Navbar Small Text',
            'sidebar_nav_small_text' => 'Sidebar Nav Small Text',
            'footer_small_text' => 'Footer Small Text',
            'sidebar_nav_flat_style' => 'Sidebar Nav Flat Style',
            'sidebar_nav_legacy_style' => 'Sidebar Nav Legacy Style',
            'sidebar_nav_compact' => 'Sidebar Nav Compact',
            'sidebar_nav_child_indent' => 'Sidebar Nav Child Indent',
            'main_sidebar_disable_hover' => 'Main Sidebar Disable Hover',
            'brand_small_text' => 'Brand Small Text',
            'navbar_variant' => 'Navbar Variant',
            'accent_color_variant' => 'Accent Color Variant',
            'sidebar_variant' => 'Sidebar Variant',
            'brand_logo_variant' => 'Brand Logo Variant',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['setting_id' => 'setting_id']);
    }
}
