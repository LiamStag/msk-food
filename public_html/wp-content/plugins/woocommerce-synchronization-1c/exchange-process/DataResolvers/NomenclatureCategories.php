<?php
namespace Itgalaxy\Wc\Exchange1c\ExchangeProcess\DataResolvers;

class NomenclatureCategories
{
    public static function process(&$reader)
    {
        // run once per exchange
        if (isset($_SESSION['IMPORT_1C']['nomenclature_categories_parse'])) {
            return;
        }

        $nomenclatureCategories = [];

        /*
         * Example xml structure
         *
        <Категории>
            <Категория>
                <Ид>c72d51b8-5bfa-11ea-7185-fa163e1c47cc</Ид>
                <Наименование>Корпус</Наименование>
                <Свойства>
                    <Ид>cec46d1a-58b4-11ea-6288-fa163e1c47cc</Ид>
                    <Ид>4dc338a8-58b5-11ea-6288-fa163e1c47cc</Ид>
                    <Ид>c308d89c-58c0-11ea-6288-fa163e1c47cc</Ид>
                    <Ид>c801e3b6-58c0-11ea-6288-fa163e1c47cc</Ид>
                    <Ид>cf0795f2-58c0-11ea-6288-fa163e1c47cc</Ид>
                    <Ид>0d730b82-58c6-11ea-6288-fa163e1c47cc</Ид>
                </Свойства>
            </Категория>
        </Категории>
         */

        while ($reader->read() &&
            !($reader->name === 'Категории' &&
                $reader->nodeType === \XMLReader::END_ELEMENT)
        ) {
            if ($reader->name !== 'Категория' || $reader->nodeType !== \XMLReader::ELEMENT) {
                continue;
            }

            $element = simplexml_load_string(trim($reader->readOuterXml()));

            $nomenclatureCategories[(string) $element->Ид] = [
                'id' => (string) $element->Ид,
                'name' => (string) $element->Наименование,
                'options' => []
            ];

            if (!isset($element->Свойства) || !isset($element->Свойства->Ид)) {
                continue;
            }

            foreach ($element->Свойства->Ид as $option) {
                $nomenclatureCategories[(string) $element->Ид]['options'][] = (string) $option;
            }
        }

        if (count($nomenclatureCategories)) {
            update_option('itglx_wc1c_nomenclature_categories', $nomenclatureCategories);
        }

        $_SESSION['IMPORT_1C']['nomenclature_categories_parse'] = true;
    }
}
