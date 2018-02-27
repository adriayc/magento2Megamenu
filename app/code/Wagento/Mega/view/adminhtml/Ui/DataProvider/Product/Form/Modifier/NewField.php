<?php
namespace Wagento\Mega\Ui\DataProvider\Product\Form\Modifier;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;
class NewField extends AbstractModifier
{
    private $locator;

    public function __construct(
        LocatorInterface $locator
    ) {
        $this->locator = $locator;
    }

    public function modifyData(array $data)
    {
        return $data;
    }

    public function modifyMeta(array $meta)
    {
        $meta = array_replace_recursive(
            $meta,
            [
                'custom_fieldset' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Custom Fieldset'),
                                'componentType' => Fieldset,
                                'dataScope' => 'data.product.custom_fieldset',
                                'collapsible' => true,
                                'sortOrder' => 5,
                            ],
                        ],
                    ],
                    'children' => [
‘custom_field’ => $this->getCustomField()
],
                ]
            ]
        );
        return $meta;
    }

    public function getCustomField()
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Custom Field'),
                        'componentType' => Field,
                        'formElement' => Select,
                        'dataScope' => 'enabled',
                        'dataType' => Text,
                        'sortOrder' => 10,
                        'options' => [
                            ['value' => '0', 'label' => __('No')],
                            ['value' => '1', 'label' => __('Yes')]
                        ],
                    ],
                ],
            ],
        ];
    }
}