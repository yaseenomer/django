# -*- coding: utf-8 -*-
##############################################################################
#
#    OpenERP, Open Source Management Solution
#    Copyright (C) 2004-2009 Tiny SPRL (<http://tiny.be>).
#    Copyright (C) 2011-Today Serpent Consulting Services PVT. LTD.
#    (<http://www.serpentcs.com>)
#    This program is free software: you can redistribute it and/or modify
#    it under the terms of the GNU Affero General Public License as
#    published by the Free Software Foundation, either version 3 of the
#    License, or (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
##############################################################################
{
    "name": "ehab",
    "version": "3.0",
    "author": "Serpent Consulting Services Pvt. Ltd.",
    "website": "http://www.serpentcs.com",
    "category": "School Management",
    "complexity": "easy",
    "description": """A module to School Management.
        A Module support the following functionalities:
        1. Admission Procedure
        2. Student Information
        3. Parent Information
        4. Teacher Information
        5. School Information
        6. Standard, Medium and Division Information
        7. Subject Information
                    """,
    "depends": ["hr",],
    "data": [            
            'ehab_view.xml','wizard/student_wizard.xml'         
    ],

    "installable": True,
    "auto_install": False,
    "application": True,
    "sequence":1
}
