import unittest
import Division as div

class TestDivisionMethods (unittest.TestCase):
    def test_IsDivisbleByZero(self):
        with self.assertRaises(ZeroDivisionError):
            div.Divide(10,0)

