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

from openerp import models, fields, api
import time
import openerp
from datetime import date
from datetime import datetime
from openerp.tools.translate import _
from openerp.tools import DEFAULT_SERVER_DATE_FORMAT, image_colorize
from openerp.tools import image_resize_image_big
from openerp.exceptions import except_orm, Warning as UserError
from openerp.modules.module import get_module_resource
from openerp import tools

class ehab_level(models.Model):
    ''' Defining an academic level '''
	
    _name = "ehab.level"
   
	
    name = fields.Char('Name', required=True, select=1,help='Name of the level')
    level_id = fields.Many2one('student.student', 'Level',)
	
    
    
    
class ehab_classes(models.Model):
    ''' Defining an academic classes '''

    _name = "ehab.class"
	
    name = fields.Char('Name', required=True, select=1,help='Name of the class')
    level = fields.Many2one('ehab.level', 'Level',) 
                                       

class student_student(models.Model):
	_name = "student.student"
	name = fields.Char('Name', required=True, select=1,help='Name of the stu')
	clas = fields.Many2one('ehab.class', 'Class',)   
	stu_level = fields.One2many('ehab.level','level_id','Student Level')
	#std_id = fields.Many2one('Student')
        subj_ids = fields.Many2many('subject.subject','student_subj_rel','std_id','subj_id','Student Subject')
        state=fields.Selection([('state1', 'State1'), ('state2', 'State2'),('state3', 'State3'), ('state4', 'State4')], track_visibility='onchange', required=False,
                                  copy=False)
        gender=fields.Selection( [('male','Male'), ('female','Female')],'Gender')
        active = fields.Boolean('active')
        _defaults = {
        'gender': 'male',
        'state': 'state1'
 
    }
        
        def in_state2(self, cr, uid, ids, context=None):
        	return self.write(cr, uid, ids, {'state': 'state2'}, context=context)
        def in_state3(self, cr, uid, ids, context=None):
        	return self.write(cr, uid, ids, {'state': 'state3'}, context=context)
        def in_state4(self, cr, uid, ids, context=None):
        	return self.write(cr, uid, ids, {'state': 'state4'}, context=context)
        def print_hello(self):
                print (self.name)
                raise osv.except_osv(_('Warning!'), _('You have already generate the purchase order(s).'))
                

                



class subject_subject(models.Model):
	_name = "subject.subject"
	name = fields.Char('Name', required=True, select=1,help='Name of the sub')
	#subj_id = fields.Many2one('Subject')
	
	
	
		
  

	
