# my_api_package/__init__.py  
from . import TodayApiGet
from . import getback

__all__ = ['TodayApiGet', 'getback'] (
    "RiotAuthenticationError",
    "RiotAuthError",
    "RiotMultifactorError",
    "RiotMultifactorAttemptError",
    "RiotRatelimitError",
    "RiotUnknownErrorTypeError",
    "RiotUnknownResponseTypeError",
    "RiotAuth",
)