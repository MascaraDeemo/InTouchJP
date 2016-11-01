using InTouch.Abstractions;
using Android.OS;

namespace InTouch.Common.Droid
{
    public class EnvironmentService : IEnvironmentService
    {
        #region IEnvironmentService implementation
        public bool IsRealDevice
        {
            get
            {
                string f = Build.Fingerprint;
                return !(f.Contains("vbox") || f.Contains("generic") || f.Contains("vsemu"));
            }
        }
        #endregion
    }
}

