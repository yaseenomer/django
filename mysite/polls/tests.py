from django.test import TestCase

# Create your tests here.
import  datetime
from django.utils import timezone

from  django.test import TestCase
from .models import Question

class QuestionMethodTests(TestCase):

    def test_was_published_recently(self):
        """
        was_puplished

        """
        time=timezone.now() + datetime.timedelta(days=30)
        future_question=Question(pub_date=time)
        self.assertIs(future_question.was_published_recently(),False)

