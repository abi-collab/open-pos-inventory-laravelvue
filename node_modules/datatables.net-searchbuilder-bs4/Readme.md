# SearchBuilder

SearchBuilder adds user defined complex search to the DataTable with the capability to search the DataTable by creating groups and conditions. This offers more advanced search controls than is currently offered by [SearchPanes](/extensions/searchpanes) or the core DataTables functionality. It is possible to set logic types for groups and apply a variety of conditions.

# Installation

The SearchBuilder extension is available on the [DataTables CDN](https://cdn.datatables.net/#SearchBuilder) and in the [download builder](/download). See the [documentation](http://datatables.net/extensions/searchbuilder/) for full details.

# NPM

You can also install it from [NPM](/download/npm/#SearchBuilder)

If you prefer to use a package manager such as NPM or Bower, distribution repositories are available with software built from this repository under the name `datatables.net-searchpanes. Styling packages for Bootstrap, Foundation and other styling libraries are also available by adding a suffix to the package name.

Please see the DataTables [NPM](//datatables.net/download/npm) installation page for further information. The [DataTables installation manual](//datatables.net/manual/installation) also has details on how to use package managers with DataTables.

# Basic Usage

SearchBuilder is initialised by placing a `Q` into the DataTables [`dom`](https://datatables.net/reference/option/dom) option. Further options can be specified using this option as an object - see the documentation for details. For example:

```js
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Qfrtip'
    });
});
```

# Documentation / Support

* [Documentation](https://datatables.net/extensions/searchbuilder/)
* [DataTables support forums](http://datatables.net/forums)

# GitHub

If you fancy getting involved with the development of SearchBuilder and help make it better, please refer to its [GitHub repo](https://github.com/DataTables/SearchBuilder)
