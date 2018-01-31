/*<?php
 header('Content-type: text/css');
 require('settings.php');
?>*/

/* @font-face {font-family:'LocalBlissHeavy';src: url('BlissPro-Heavy.otf');} */

@media print {
    .noprint, .noprint *
    {
        display: none !important;
    }
    
    .checklist-container {
        height: 94% !important;
        width: 100% !important;
        left: 0 !important;
    }
    
    .checklist-item {
      font-size: 14pt !important;
      margin: .4em 4em .4em 0 !important;
    }
}

body {
-webkit-tap-highlight-color: rgba(0, 0, 0, 0);  
color: #000000;
padding: 0;
background-color: #ffffff;
font-family: LocalBlissHeavy, "Lucida Sans", sans-serif;
font-size: .7em;
cursor: default !important
}

.clear {
clear: both;
}

.menu-bar {
position: fixed;
top: 0;
left: 0;
width: 100%;
background-color: #cccccc;
}

p {
border: 0;
padding: 0;
margin: 0;
}

table {
 border-collapse: collapse; 
}

tr:hover {
background-color: #dddddd;
}

td {
text-align: center; 
padding: 4px 3px;
border: 1px solid;
}

input {
 border: none;
 background-color: inherit;
}

input.button {
 border: 1px solid;
 padding: 5px;
 margin: 10px;
}

tr.header {
 font-weight: 900; 
}

tr.header td {
 text-align: left; 
}

a {
text-decoration: none;
}

h2 {
background-color: #000000;
color: #ffffff;
padding: 5px;
margin: 5px 5px 0 5px;
}

.group {
//border: #000000 2px solid;
//margin: 0 5px 20px 5px;
//padding: 5px;
background-color: #ffffff;
}


.group-column {
float: left;
padding: 0;
/* width: <?php echo(100/$settings['columns']); ?>%; */
}

.employee-data {
color: #ffffff;
padding: .3em;
margin: 2px 1px;
background: url(bg_employee.png) top left repeat-x;
overflow: hidden;
//height: 4.4em;
}

.employee-data-keyholder {
  background-image: url(key.png), url(bg_employee.png);
  background-position: right 4px, top left;
  background-repeat: no-repeat, repeat-x;
}


.employee-data-section {
padding: 0;
overflow: hidden;
width: 100%;
white-space: nowrap;
}

.employee-firstname {
font-size: 1.8em;
font-weight: 900;
text-transform: uppercase;

margin-bottom: -.2em;
}

.employee-surname {
text-transform: uppercase;
font-size: 1em;
font-weight: 900;
margin-top: -.3em;
}

.employee-keyholder-section {
float: right;
position: absolute;
right: 10;
margin-left: 5px;
}

hr {
height: 1px;
background-color: #666666;
border: none;
}

.employee-notes-section {
float: right;
margin: 0;
padding: 0;
overflow: hidden;
}

.employee-status {
color: #eee ;
margin: 0;
padding: 0;
}


.group-flex {
display: flex;
flex-direction: row;
flex-wrap: wrap;
justify-content: flex-start;
align-items: center;
align-content: stretch;
height: 100%;
/* border: #000000 2px solid; */
}

.clickable-div-link { 
  position: absolute; 
  width: 100%;
  height: 100%;
  top:0;
  left: 0;
  z-index: 1;
} 

.side-menu-item {
  position: relative;
  height: 4em;
  font-size: 1.5em;
  padding: .25em 1em;
  border: 1px solid #000;
  margin: 1em;
}

.side-menu-item-active {
  background-color: #ccccff;
  border: 1px solid #00f;
}


.side-menu-item:hover {
background: #cccccc;
}

.column-flex {
display: flex;
flex-direction: column;
flex-wrap: wrap;
justify-content: flex-start;
align-items: center;
align-content: stretch;
height: 100%;
flex-grow: 1;
}

.employee-data-flex {
flex-grow: 1;
height: 0 !important; /* Flex box will grow as much as possible */
width: 92%;
padding: 4%;
margin: 0;
border-bottom: 1px solid #fff;
border-left: 1px solid #fff;
position: relative;
max-height: 5em;
}


#selector {
position: fixed;
width: 10%;
border: 1px solid #666666;
}

#selector a {
color: #666666;
}

#selector strong {
color: #000000 !important;
}

.side-menu {
width: 10%;
height: 100%;
position: fixed;
}

.main-section {
width: 90%;
height: 100%;
position: relative;
left: 10%;
}


.checklist-container {
height:90%;
width: 50%;
margin: 0;
position: relative;
left: 30%;
padding: 0 1em;
display: inline-flex;
flex-flow: column wrap;
justify-content: flex-start;
align-items: flex-start;
align-content: space-between;
}

.checklist-item {
  font-size: 11pt;
  margin: .3em 4em .3em 0;
}

h1.checklist {
  padding: 0;
  margin: 0 0 1% 0;
  color: #e2001a;
  font-size: 3em;
  height: 5%;
  overflow: hidden;
  text-align: center;
}
