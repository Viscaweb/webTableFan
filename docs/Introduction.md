Introduction
============

This library allows to generate HTML Tables from a series of flexible models.  
Tables are represented through three kind of models, each of them represent a different
component of the HTML tables:

- Table
- Body
- Rows
- Cells

The concept is that every model has a service contains the data elements that it and its children components may use.  
Then, a linked service to that specific model needs to be implemented to retrieve its attributes and children elements.


### Let's see an example:

Let's say we want to render the following table:

    <table class="table-fancy">
       <tbody class="body-fance" data-id="3">
            <tr>
                <td><input type="checkbox" name="elements[]"/></td>
                <td>FC Barcelona</td>
                <td>34 goals</td>
            </tr>
       </tbody>
    </table>
    

First analyze what elements you will need. These are:

- A root table component
- A body component
- A row component
- 3 different cell components

Let's create the root table model component.

    class FancyTableModel extends AbstractTableModel {
    
    }
    
An `AbstractTableModel` is offered for convenience, it implements the basic methods and a specific constructor, but you finally need to implement the interface `TableModelInterface`.

As the example table is rendering a list of teams, the Table model will need the list of teams, so let's add this property (let's use a ficticious Team class):

    class FancyTableModel extends AbstractTableModel {
        /** @var Teams[] */
        protected $teams;
        
        public function __construct(string $id, string $variantId = 'default')
        {
            parent::__construct($id, $variantId);
        }
    }