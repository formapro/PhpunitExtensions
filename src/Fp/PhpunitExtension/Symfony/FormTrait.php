<?php
namespace Fp\PhpunitExtension\Symfony;

class FormTrait 
{
    /**
     * @param mixed $form
     */
    public function assertInstanceOfForm($form)
    {
        $this->assertInstanceOf('Symfony\Component\Form\FormInterface', $form);
    }

    /**
     * @param mixed $form
     * @param string $childName
     */
    public function assertFormHasChild($form, $childName)
    {
        //guard
        $this->assertInstanceOfForm($form);

        $this->assertTrue($form->has($childName), sprintf(
            'Failed assert form `%s` has a child form `%s`',
            $form->getName(),
            $childName
        )); 
    }

    /**
     * @param mixed $form
     * @param string $childName
     */
    public function assertFormNotHasChild($form, $childName)
    {
        //guard
        $this->assertInstanceOfForm($form);

        $this->assertFalse($form->has($childName), sprintf(
            'Failed assert form `%s` has not a child form `%s`',
            $form->getName(),
            $childName
        ));
    }

    /**
     * @param mixed $form
     */
    public function assertFormValid($form)
    {
        //guard
        $this->assertInstanceOfForm($form);

        $this->assertTrue($form->isValid(), sprintf(
            "Failed assert form `%s` valid. Form errors: \n\n%s\n\n",
            $form->getName(),
            $form->getErrorsAsString()
        ));
    }

    /**
     * @param mixed $form
     */
    public function assertFormNotValid($form, $expectedErrorMessage = 'ERROR:')
    {
        //guard
        $this->assertInstanceOfForm($form);

        $this->assertFalse($form->isValid(), sprintf(
            "Failed assert the form `%s` is invalid.",
            $form->getName()
        ));

        $this->assertContains($expectedErrorMessage, sprintf(
            "Failed assert the form `%s` contains error `%s`. Form errors: \n\n%s\n\n",
            $form->getName(),
            $expectedErrorMessage,
            $form->getErrorsAsString()
        ));
    }
}