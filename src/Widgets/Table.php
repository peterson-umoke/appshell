<?php

declare(strict_types=1);

/**
 * Contains the Table class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-01-09
 *
 */

namespace Konekt\AppShell\Widgets;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Konekt\AppShell\Contracts\Theme;
use Konekt\AppShell\Contracts\Widget;
use Konekt\AppShell\Traits\RendersThemedWidget;
use Konekt\AppShell\Widgets\Table\Columns;
use Konekt\AppShell\Widgets\Table\Footer;

class Table implements Widget
{
    use RendersThemedWidget;

    public Columns $columns;

    public Collection $data;

    public array $options = [];

    public ?Footer $footer;

    public function __construct(Theme $theme, array $columns = [], array $options = [])
    {
        $this->theme = $theme;
        $this->columns = new Columns($columns);
        $this->options = $options;
        $this->data = collect([]);
        $this->footer = isset($options['footer']) ? new Footer($options['footer']) : null;
    }

    public static function create(Theme $theme, array $options = []): Table
    {
        return new static($theme, $options['columns'] ?? [], Arr::except($options, 'columns'));
    }

    public function rendersAlternativeForEmptyDataset(): bool
    {
        return !empty($this->options['empty']['text'] ?? '');
    }

    public function hasFooter(): bool
    {
        return null !== $this->footer;
    }

    public function headerIsHidden(): bool
    {
        return false === ($this->options['header'] ?? null);
    }

    public function render($data = null): string
    {
        if ($data instanceof Collection) {
            $this->data = $data;
        } elseif (is_array($data)) {
            $this->data = collect($data);
        } else {
            $this->data = collect([]);
        }

        return $this->renderViewFromTheme('table', ['table' => $this]);
    }
}
