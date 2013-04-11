A skeleton is placed in /lib/skeleton

You specific name of your expected skeleton to generate

A file in strcuture without specificed template will be empty

Files with template will generate according to template content and substitution (need to reuse a lot of substitution but also having to allow to customizing subsitution behavior --> recommend strategy pattern for generate replaced, replacing values and template pattern) 

A template will have a corresspondence substitution file if it is specificed in subsitution_template mapping file in template folder

If no substitution is found, default substitution will be invoked 

