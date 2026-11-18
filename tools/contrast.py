import sys, json
def lum(h):
    h=h.lstrip('#'); r,g,b=[int(h[i:i+2],16)/255 for i in (0,2,4)]
    f=lambda c: c/12.92 if c<=0.03928 else ((c+0.055)/1.055)**2.4
    return 0.2126*f(r)+0.7152*f(g)+0.0722*f(b)
def cr(a,b):
    la,lb=lum(a),lum(b); 
    if la<lb: la,lb=lb,la
    return (la+0.05)/(lb+0.05)
if __name__=="__main__":
    light=dict(base="#ffffff",contrast="#1a1a1a",primary="#0b5d7a",primary_dark="#083f55",accent="#9a3d00",surface="#eaf4f7",muted="#4a5560")
    dark=dict(base="#121212",contrast="#f2f2f2",primary="#7cc4e0",primary_dark="#a9dcee",accent="#ffb27a",surface="#1e2a30",muted="#b8c2ca")
    pairs=[("contrast","base"),("primary","base"),("base","primary"),("base","primary_dark"),("accent","base"),("contrast","surface"),("primary","surface"),("accent","surface"),("muted","base"),("muted","surface"),("base","accent")]
    for name,p in (("jasny",light),("ciemny",dark)):
        print(name)
        for a,b in pairs:
            v=cr(p[a],p[b]); print(f"  {a:13s} na {b:13s} {p[a]} / {p[b]}  {v:5.2f}  {'OK' if v>=4.5 else 'ZA NISKI'}")
