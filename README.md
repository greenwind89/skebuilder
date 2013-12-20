A skeleton is placed in /lib/skeleton

You specific name of your expected skeleton to generate

A file in strcuture without specificed template will be empty

>>>>> special thing in skeleton is we can use metadata from <data> tag to user in naming file and folder
>>>>> by using "meta:name_of_metadata", fo ex: "meta:skeleton_id"

Files with template will generate according to template content and substitution 

replacement is a class which will perform substituting action 

A template will have a corresspondence substitution file if it is specificed in subsitution_template mapping file in template folder

It looks just like this

(need to reuse a lot of substitution but also having to allow to customizing subsitution behavior --> recommend strategy pattern for generate replaced, replacing values and template pattern) 
Below will get phpfox_default_1 as replacement class, if this class doesn't exist, it will have error
<template name='phpfox_block_default' package='phpfox'>
	<content>/template/phpfox_block_default.tpl</content>
	<replacement>phpfox_default_1</replacement> 
</template>
name is id of template, it is unique for each package
prefix doesn't matter here, just to make it more meaningful


this will get default replacement
<template name='se_block_default_2' package='phpfox'>
	<content>/template/phpfox_block_default_2.tpl</content>
</template>



If no substitution is found, default substitution will be invoked 

Add a template in to Skebuilder 

 + Create a template file int /lib/template, copy all file you want to make it template into new created file

 + Replace string with appropriate substitution or create a new one and  follow add a replacement steps as below


Add a replacement. After creating a new template, you need to add some replacement into for exmaple: ReplacementPhpfox

	+ Define the vocabulary to substitute in ReplacementPhpfox, to make it integerity, all vocabulary in $matching_array are valid subtitution, so you need to add your new one into this. Don't worry about [skebuilder:], system will add it automatically into vacabulary  

	+ Add substituation vocab and coressponding value by for ex: $this->addKeyValueIntoReplacementList('module_name', $this->context->getModuleName());. Hint: using context object to retrieve value for replacement

	+ You should also add a unittest as in ReplacementPhpfoxTest for new added replacement
	
 HOw to test easily the template